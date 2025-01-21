<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ClassModel;
use App\Models\User;
use App\Models\StudentAddFeesModel;
use App\Models\SettingModel;
use App\Exports\ExportCollectFees;
use Stripe\Stripe;
use Auth;
use Session;
use Excel;

class FeesCollectionController extends Controller
{
    public function collect_fees(Request $request)
    {
        $data['getClass'] = ClassModel::getClass();
        if(!empty($request->all()))
        {
            $data['getRecord'] = User::getCollectFeesStudent();
        }
        $data['header_title'] = "Collect Fees";
        return view('admin.fees_collection.collect_fees', $data);
    }

    // Fees Collection Report
    public function collect_fees_report()
    {        
        $data['getClass'] = ClassModel::getClass();
        
        $data['getRecord'] = StudentAddFeesModel::getRecord();
        $data['header_title'] = "Collect Fees Report";
        return view('admin.fees_collection.collect_fees_report', $data);
    }

    // Export to Excel
    public function export_collect_fees_report(Request $request)
    {
        return Excel::download(new ExportCollectFees, 'Collect_Fees_Report_'.date('Y-m-d').'.xlsx');
    }

    public function collect_fees_add($student_id)
    {
        $data['getFees'] = StudentAddFeesModel::getFees($student_id);
        $getStudent = User::getSingleClass($student_id);
        $data['getStudent'] = $getStudent;
        $data['header_title'] = "Add Collect Fees";
        $data['paid_amount'] = StudentAddFeesModel::getPaidAmount($student_id, $getStudent->class_id);
        return view('admin.fees_collection.add_collect_fees', $data);   
    }

    public function collect_fees_insert($student_id, Request $request)
    {
        $getStudent = User::getSingleClass($student_id);
        $paid_amount = StudentAddFeesModel::getPaidAmount($student_id, $getStudent->class_id);
        if(!empty($request->amount))
        {
            $RemaningAmount = $getStudent->amount - $paid_amount;
            if($RemaningAmount >= $request->amount)
            {
                $remaning_amount_user = $RemaningAmount - $request->amount;

                $payment = new StudentAddFeesModel;
                $payment->student_id = $student_id;
                $payment->class_id = $getStudent->class_id;
                $payment->paid_amount = $request->amount;
                $payment->total_amount = $RemaningAmount;
                $payment->remaning_amount = $remaning_amount_user;
                $payment->payment_type = $request->payment_type;
                $payment->remark = $request->remark;
                $payment->created_by = Auth::user()->id;
                $payment->is_payment = 1;
                $payment->save();

                return redirect()->back()->with('success', "Fees successfully added");
            }
            else
            {
                return redirect()->back()->with('error', "Your amount go to greather than remaning amount");   
            }
        }
        else
        {
            return redirect()->back()->with('error', "You need add your amount at least 1$");
        }
    }

    // Student side
    public function CollectFeesStudent(Request $request)
    {
        $student_id = Auth::user()->id;
        $data['getFees'] = StudentAddFeesModel::getFees($student_id);

        $getStudent = User::getSingleClass($student_id);
        $data['getStudent'] = $getStudent;
        $data['header_title'] = "Fees Collection";
        $data['paid_amount'] = StudentAddFeesModel::getPaidAmount(Auth::user()->id, Auth::user()->class_id);
        return view('student.my_fees_collection', $data); 
    }

    public function CollectFeesStudentPayment(Request $request)
    {
        $getStudent = User::getSingleClass(Auth::user()->id);
        $paid_amount = StudentAddFeesModel::getPaidAmount(Auth::user()->id, Auth::user()->class_id);

        if(!empty($request->amount))
        {
            $RemaningAmount = $getStudent->amount - $paid_amount;
            if($RemaningAmount >= $request->amount)
            {
                $remaning_amount_user = $RemaningAmount - $request->amount;

                $payment = new StudentAddFeesModel;
                $payment->student_id = Auth::user()->id;
                $payment->class_id = Auth::user()->class_id;
                $payment->paid_amount = $request->amount;
                $payment->total_amount = $RemaningAmount;
                $payment->remaning_amount = $remaning_amount_user;
                $payment->payment_type = $request->payment_type;
                $payment->remark = $request->remark;
                $payment->created_by = Auth::user()->id;
                $payment->save();

                $getSetting = SettingModel::getSingle();

                // Paypal payment don't working now when we make the acount paypal just see the record 95 school mis
                if($request->payment_type == 'Paypal')
                {
                    $query = array();
                    $query['business']          = $getSetting->paypal_email;
                    $query['cmd']               = '_xclick';
                    $query['item_name']         = "Student Fees";
                    $query['no_shipping']       = '1';
                    $query['item_number']       = $payment->id;
                    $query['amount']            = $request->amount;
                    $query['currency_code']     = 'USD';
                    $query['cancel_return']     = url('student/paypal/payment-error');
                    $query['return']            = url('student/paypal/payment-success');

                    $query_string = http_build_query($query);

                    // header('Location: https://www.paypal.com/cgi-bin/webscr?' . $query_string);
                    header('Location: https://www.sandbox.paypal.com/cgi-bin/webscr?' . $query_string);
                    exit();

                }
                // Stripe also don't working - Invalid API Key provided error
                elseif($request->payment_type == 'Stripe')
                {
                    $setPublicKey   = $getSetting->stripe_key;
                    $setApiKey      = $getSetting->stripe_secret;

                    Stripe::setApiKey($setApiKey);
                    $finalprice = $request->amount * 100;

                    $session = \Stripe\Checkout\Session::create([
                        'customer_email' => Auth::user()->email,
                        'payment_method_types' => ['card'],
                        'line_items' => [[
                            'name' => 'Student Fees',
                            'description' => 'Student Fees',
                            'images' => [ url('') ],
                            'amount' => intval($finalprice),
                            'currency' => 'usd',
                            'quantity' => 1,
                        ]],
                        'success_url' => url('student/stripe/payment-success'),
                        'cancel_url' => url('student/stripe/payment-error'),
                    ]);

                    $payment->stripe_session_id = $session['id'];
                    $payment->save();

                    $data['session_id'] = $session['id'];
                    Session::put('stripe_session_id', $session['id']);
                    $data['setPublicKey'] = $setPublicKey;

                    return view('stripe_charge', $data);
                }
            }
            else
            {
                return redirect()->back()->with('error', "Your amount go to greather than remaning amount");
            }
        }
        else
        {
            return redirect()->back()->with('error', "You need add your amount at least 1$");
        }
    }

    // Stripe - // Stripe also don't working - Invalid API Key provided error
    public function PaymentSuccessStripe(Request $request)
    {
        
    }

    // Paypal payment don't working now when we make the acount paypal just see the record 95 school mis
    public function PaymentError()
    {
        return redirect('student/fees_collection')->with('error', 'Due to some error please try again');
    }

    // Paypal payment don't working now when we make the acount paypal just see the record 95 school mis
    public function PaymentSuccess(Request $request)
    {
        dd($request->all());
    }
}
