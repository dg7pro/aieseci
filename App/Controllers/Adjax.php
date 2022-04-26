<?php


namespace App\Controllers;


use App\Models\Expense;
use App\Models\File;
use App\Models\Group;
use App\Models\Notice;
use App\Models\Order;
use App\Models\Query;
use App\Models\Student;
use App\Models\Subject;
use App\Models\Todos;
use App\Models\User;

/**
 * Class Adjax Controller
 *
 * @package App\Controllers
 */
class Adjax extends Administered
{

    public function fetchCourseDetails(){

        if(isset($_POST['groupId']) && isset($_POST['groupId'])!=''){

            $group_id = $_POST['groupId'];

            $results = Subject::fetchAllWithLesson($group_id);
            $num = count($results);

            /*if($num>0){
                $response = $groupInfo;
            }else{
                $response['status']=200;
                $response['message']="No data found!";
            }
            echo json_encode($response);*/


            $data = '<div>';

            if($num>0){
                foreach($results as $row) {
                    $data .= '<h5 class="text-primary">'.$row['no'].': '.$row['sub'].'</h5>';
                    if( count($row['lessons']) > 0){
                        $data .= '<ul>';
                            foreach($row['lessons'] as $ls) {
                                if($ls['title']!=NULL){
                                    $data .= ' <li><i class="fas fa-angle-right"></i> '. $ls['title'] .'</li>';
                                }
                            }
                        $data .= '</ul><br>';

                    }
                }

                $data .='<hr><h5 class="text-primary">+Plus Free</h5>
                        <ul class="text-success mark">
                        <li><i class="fas fa-angle-right"></i> <b>Specimens</b></li>
                        <li><i class="fas fa-angle-right"></i> <b>Model Test Papers</b></li>
                        <li><i class="fas fa-angle-right"></i> <b>Important tips and hints</b></li>
                        </ul>';
            }else{
                $data .='<h5 class="text-primary text-center">Coming Soon</h5>
                        <ul class="text-success mark text-center">
                        <li><i class="fas fa-angle-right"></i> <b>From next session</b></li>
                        <li><i class="fas fa-angle-right"></i> <b>June 2021</b></li>                       
                        </ul>';

            }

            $data .='</div>';
            echo $data;

        }
    }

    /* ==================================================================
     * Expense: Ajax 1 Functions Bundle
     * Used in list_expense view
     * ====================================================================
     * */
    /**
     * Fetch all expenses
     */
    public function fetchExpenseRecords(){

        if(isset($_POST['readrecord'])){
            $data = '<table class="table table-bordered">
                <thead>
                <tr>
                    <th scope="col">Id</th>
                    <th scope="col">Date</th>
                    <th scope="col">Description</th>
                    <th scope="col">Amount</th>                                      
                    <th scope="col">Update</th>
                    <th scope="col">Delete</th>                   
                </tr></thead><tbody>';

            $results = Expense::fetchAll();
            $num = count($results);

            if($num>0){
                foreach($results as $row) {
                    $data .= '<tr>
                    <td>'.$row['id'].'</td>                
                    <td>'.$row['dated'].'</td>
                    <td>'.$row['tag'].'</td>
                    <td>Rs. '.$row['amount'].'</td>
                    <td><button onclick="getExpenseInfo('.$row['id'].')" type="button" class="mb-1 btn btn-sm btn-info">Edit</button></td>                 
                    <td><button onclick="deleteExpenseInfo('.$row['id'].')" type="button" class="mb-1 btn btn-sm btn-danger">Del</button></td>
                </tr>';
                }
            }

            $data .='</tbody></table>';
            echo $data;
        }
    }

    /**
     * Add new group
     */
    public function insertNewExpenseRecord(){

        if(isset($_POST['amount']) && $_POST['amount']!=''){

            $re = Expense::insert($_POST);
            if(!$re){
                echo 'Please fill all the fields correctly';
            }
            echo 'New Group Created';

        }
    }

    /**
     *  Fetch group
     */
    public function fetchSingleExpenseRecord(){

        if(isset($_POST['expenseId']) && isset($_POST['expenseId'])!=''){

            $expense_id = $_POST['expenseId'];
            $expenseInfo = Expense::fetch($expense_id);
            $num = count($expenseInfo);
            if($num>0){
                $response = $expenseInfo;
            }else{
                $response['status']=200;
                $response['message']="No data found!";
            }
            echo json_encode($response);

        }
    }

    /* ========================================================
     * Student
     * =============================================
     * */

    /**
     * Add new group
     */
    public function insertNewStudentRecord(){

        if(isset($_POST['first_name']) && $_POST['first_name']!=''){

            $re = Student::createAccount($_POST);
            if(!$re){
                echo 'Please fill all the fields correctly';
            }
            echo 'New Student Account Created';

        }
    }

    /* ==================================================================
     * Todos: Ajax 1 Functions Bundle
     * Used in list_expense view
     * ====================================================================
     * */
    /**
     * Fetch all expenses
     */
    public function fetchTodosRecords(){

        if(isset($_POST['readrecord'])){
            $data = '<table class="table table-bordered">
                <thead>
                <tr>
                    <th scope="col">Id</th>
                    <th scope="col">Task</th>                   
                    <th scope="col">Deadline</th>                                      
                    <th scope="col">By</th>
                    <th scope="col">Complete</th>                   
                    <th scope="col">Edit</th>                   
                    <th scope="col">Del</th>                   
                </tr></thead><tbody>';

            $results = Todos::fetchAll();
            $num = count($results);

            if($num>0){
                foreach($results as $row) {
                    $data .= '<tr>
                    <td>'.$row['id'].'</td>                
                    <td>'.$row['task'].'</td>
                    <td>'.$row['deadline'].'</td>
                    <td>'.$row['fn'].'</td>
                    <td>'.$row['is_complete'].'</td>
                    <td><button onclick="getTodosInfo('.$row['id'].')" type="button" class="mb-1 btn btn-sm btn-info">Edit</button></td>                 
                    <td><button onclick="deleteTodosInfo('.$row['id'].')" type="button" class="mb-1 btn btn-sm btn-danger">Del</button></td>
                </tr>';
                }
            }

            $data .='</tbody></table>';
            echo $data;
        }
    }

    /**
     * Add new group
     */
    public function insertNewTodosRecord(){

        if(isset($_POST['task']) && $_POST['task']!=''){

            $re = Todos::insert($_POST);
            if(!$re){
                echo 'Please fill all the fields correctly';
            }
            echo 'New Task Created';

        }
    }

    /**
     *  Fetch group
     */
    public function fetchSingleTodosRecord(){

        if(isset($_POST['expenseId']) && isset($_POST['expenseId'])!=''){

            $expense_id = $_POST['expenseId'];
            $expenseInfo = Todos::fetch($expense_id);
            $num = count($expenseInfo);
            if($num>0){
                $response = $expenseInfo;
            }else{
                $response['status']=200;
                $response['message']="No data found!";
            }
            echo json_encode($response);

        }
    }

    /**
     *  Fetch group
     */
    public function fetchSingleInquiryRecord(){

        if(isset($_POST['inquiryId']) && isset($_POST['inquiryId'])!=''){

            $inquiry_id = $_POST['inquiryId'];
            $inquiryInfo = Query::fetch($inquiry_id);
            $num = count($inquiryInfo);
            if($num>0){
                $response = $inquiryInfo;
            }else{
                $response['status']=200;
                $response['message']="No data found!";
            }
            echo json_encode($response);

        }
    }

    /**
     * Update group
     */
    public function updateSingleInquiryRecord(){


//        var_dump($_POST);
//        exit();
        if(isset($_POST['id']) && $_POST['id']!=''){

            $re = Query::update($_POST);
            if($re){
                echo 'Basic Info Updated';

            }else{
                echo 'Something went Wrong';
            }


        }
    }







    /* ==================================================================
     * Group: Ajax 5 Functions Bundle
     * Used in list_group view
     * ====================================================================
     * */

    /**
     * Fetch all groups
     */
    public function fetchGroupRecords(){

        if(isset($_POST['readrecord'])){
            $data = '<table class="table table-bordered">
                <thead>
                <tr>
                    <th scope="col">Id</th>
                    <th scope="col">Short</th>
                    <th scope="col">Name</th>
                    <th scope="col">Fees</th>
                    <th scope="col">Discount</th>
                    <th scope="col">Part_P</th>
                    <th scope="col">Deactive</th>
                    <th scope="col">Update</th>
                    <th scope="col">Delete</th>
                    <th scope="col">Manage</th>
                    <th scope="col">Colour</th>
                           
                </tr></thead><tbody>';

            $results = Group::fetchAll();
            $num = count($results);

            if($num>0){
                foreach($results as $row) {
                    $data .= '<tr>
                    <td>'.$row['id'].'</td>
                    <td>'.$row['short'].'<span class="small text-danger mark"><em>'.( $row['open']!=1?' Coming Soon ':'' ).'</em></span></td>
                    <td><a href="/admin/details?id='.$row['id'].'">'.$row['name'].'</a></td>
                    <td>Rs. '.$row['fees'].'</td>
                    <td>upto '.$row['discount'].'</td>
                    <td>'.$row['instalments'].'</td>
                    <td><span class="small text-danger"><em>'.($row['deactive']==1?'Yes':'').'</em></span></td>
                    <td><button onclick="getGroupInfo('.$row['id'].')" type="button" class="mb-1 btn btn-sm btn-info">Edit</button></td>                 
                    <td><button onclick="deleteGroupInfo('.$row['id'].')" type="button" class="mb-1 btn btn-sm btn-danger">Del</button></td>
                    <td><a href="/admin/list-subject?gid='.$row['id'].'" class="mb-1 btn btn-sm btn-warning">Subjects</a></td>
                    <td><div style="width:25px; height:25px; background-color: '.$row['color'].'" ></div></td>
                </tr>';
                }
            }

            $data .='</tbody></table>';
            echo $data;
        }
    }

    /**
     *  Fetch group
     */
    public function fetchSingleGroupRecord(){

        if(isset($_POST['groupId']) && isset($_POST['groupId'])!=''){

            $group_id = $_POST['groupId'];
            $groupInfo = Group::fetch($group_id);
            $num = count($groupInfo);
            if($num>0){
                $response = $groupInfo;
            }else{
                $response['status']=200;
                $response['message']="No data found!";
            }
            echo json_encode($response);

        }
    }

    public function applyDiscount(){
        if(isset($_POST['discount'])){

            $discount_rate = $_POST['discount'];

            $groups = Group::fetchGroupPriceList();

            foreach($groups as $group){
                $process[] = '';
                $discount_price = $group['price'] - $group['price']/100*$discount_rate;

                $process['id'] = $group['id'];
                $process['price'] = round($discount_price);
                $process['rate'] = $discount_rate;

                Group::processDiscount($process);
            }
        }
        echo "All groups updated";
    }

    public function removeDiscount(){

        $groups = Group::fetchGroupPriceList();

        foreach($groups as $group){
            $process[] = '';

            $process['id'] = $group['id'];
            $process['price'] = 0;
            $process['rate'] = 0;

            Group::processDiscount($process);
        }

        echo "Discount Removed Successfully";
    }

    /**
     * Add new group
     */
    public function insertNewGroupRecord(){

        if(isset($_POST['name']) && $_POST['name']!=''){

            $re = Group::insert($_POST);
            if(!$re){
                echo 'Something went Wrong';
            }
            echo 'New Group Created';

        }
    }

    /**
     * Update group
     */
    public function updateSingleGroupRecord(){

        if(isset($_POST['id'])){

            $re = Group::update($_POST);
            if(!$re){
                echo 'Something went Wrong';
            }
            echo 'Basic Info Updated';

        }
    }

    /**
     * Delete group
     */
    public function deleteGroupRecord(){

        if(isset($_POST['id'])){

            // Real code for deleting group records
            /*$subjects = Subject::fetchAll($_POST['id']);
            $subject_count = count($subjects);

            if($subject_count == 0){

                $re = Group::deleteRecord($_POST['id']);
                if(!$re){
                    $response['status']=false;
                    $response['message']='Something is wrong with sql table, please inform web developer';

                }else{
                    $response['status']=true;
                    $response['message']='Deleted Group Permanently';
                }

            } else {

                $response['status']=false;
                $response['message']='Can\'t be deleted. This group contains subjects';

            }*/

            $response['status']=false;
            $response['message']='Application says Don\'t delete anything, just change or modify it to continue' ;
            echo json_encode($response);
        }
    }
    /* *** */

    /* ==================================================================
     * Groups Order: Ajax 2 Functions Bundle
     * Used in change_group_order view
     * ====================================================================
     * */

    public function listGroupsForChangingOrderAction(){

        if(isset($_POST['readrecord'])){
            $data = '<table class="table table-bordered">
                <tbody>';

            $arr = Group::fetchAll();
            $sno = count($arr);
            $sno_arr=array();
            for ($i=1;$i<=$sno;$i++){
                array_push($sno_arr,$i);
            }

            if(count($arr)>0){
                foreach ($arr as $grp){
                    $data .= '<tr>
                    <td>'.$grp['sno'].'</td>                           
                    <td>
                        <a href="/lesson/display?pdf='.$grp['name'].'" target="_blank">'.$grp['name'].'</a>
                       
                    </td>
                    <td>'.$grp['sno'].'</td>
                    <td>
                        <select class="form-control" id="exampleFormControlSelect1" name="sno'.$grp['id'].'" onchange="setSno('.$grp['id'].',this.value)">
                            <option>Change Order</option>
                            ';
                    for($i=1;$i<=$sno;$i++){
                        $data .='<option value="'.$i.'">'.$i.'</option>';
                    }
                    $data .='
                        </select>
                    </td>
                    </tr>';
                }

            }

            $data .='</tbody></table>';
            echo $data;

        }
    }

    /**
     * Change Order of File Contents
     */
    public function changeGroupOrderAction(){

        if(isset($_POST['id']) && isset($_POST['sno'])){

            $re = Group::updateOrder($_POST['sno'],$_POST['id']);
            if(!$re){
                echo 'Something went Wrong';
            }
            echo 'Order Updated Successfully';

        }
    }
    /* *** */


    /* ==================================================================
     * Subject: Ajax 5 Functions Bundle
     * Used in list_subject view
     * ====================================================================
     * */

    /**
     * Fetch all subjects
     */
    public function fetchSubjectRecords(){

        $groupId = $_POST['groupId'];

        if(isset($_POST['readrecord'])){
            $data = '<table class="table table-bordered">
                <thead>
                <tr>                   
                    <th scope="col">Name</th>
                    <th scope="col">All Contents</th> 
                    <th scope="col">Pdf Contents</th>
                    <th scope="col">Txt Contents</th>                                       
                    <th scope="col">Update</th>
                    <th scope="col">Delete</th>                    
                           
                </tr></thead><tbody>';

            $results = Subject::fetchAll($groupId);
            $num = count($results);

            if($num>0){
                foreach($results as $row) {
                    $data .= '<tr>                    
                    <td>'.$row['name'].' <span class="small text-muted mark"><em>No. of units: '.$row['units'].'</em></span></td>
                    <td><a href="/admin/list-content-all?sid='.$row['id'].'" class="mb-1 btn btn-sm btn-dark">View n Order</a></td>  
                     <td><a href="/admin/list-content-pdf?sid='.$row['id'].'" class="mb-1 btn btn-sm btn-primary">Manage</a></td>
                    <td><a href="/admin/list-content-txt?sid='.$row['id'].'" class="mb-1 btn btn-sm btn-warning">Manage</a></td>  
                    <td><button onclick="getSubjectInfo('.$row['id'].')" type="button" class="mb-1 btn btn-sm btn-info">Edit</button></td>                 
                    <td><button onclick="deleteSubjectInfo('.$row['id'].')" type="button" class="mb-1 btn btn-sm btn-danger">Del</button></td>
                    
                </tr>';
                }
            }

            $data .='</tbody></table>';
            echo $data;
        }
    }

    /**
     * Fetch single subject
     */
    public function fetchSingleSubjectRecord(){

        if(isset($_POST['subjectId']) && isset($_POST['subjectId'])!=''){

            $subject_id = $_POST['subjectId'];
            $subjectInfo = Subject::fetch($subject_id);
            $num = count($subjectInfo);
            if($num>0){
                $response = $subjectInfo;
            }else{
                $response['status']=200;
                $response['message']="No data found!";
            }
            echo json_encode($response);
        }
    }

    /**
     * Add new subject record
     */
    public function insertNewSubjectRecord(){

        if(isset($_POST['name']) && $_POST['name']!=''){

            $re = Subject::insert($_POST);
            if(!$re){
                echo 'Something went Wrong';
            }
            echo 'New Subject Created';

        }
    }

    /**
     * Update subject record
     */
    public function updateSingleSubjectRecord(){

        if(isset($_POST['id'])){

            $re = Subject::update($_POST);
            if(!$re){
                echo 'Something went Wrong';
            }
            echo 'Basic Info Updated';

        }
    }

    /**
     * Delete subject record
     */
    public function deleteSubjectRecord(){

        if(isset($_POST['id'])){

            // Real code for deleting Content Records
            /*$re = Subject::deleteRecord($_POST['id']);
            if(!$re){
                echo 'Something went Wrong';
            }
            echo 'Deleted Subject Permanently';*/

            $response['status'] = false;
            $response['message'] = 'Application says Don\'t delete anything, just change or modify it to continue';
            echo json_encode($response);

        }
    }
    /* *** */


    /* ==================================================================
     * Users: Ajax 2 Functions Bundle
     * Used in list_user view
     * ====================================================================
     * */

    /**
     * Fetch user course association
     */
    public function fetchUserCourseRecord(){

        $user_id = $_POST['userId'];
        $thisUser = User::findByID($user_id);
        $results = $thisUser->groups();
        $results_count = count($results);

        $output = '<table class="table table-striped table-bordered">
                    <tr>
                    <th>Group Name</th>
                    </tr>';

        if($results_count > 0){
            foreach($results as $row){
                $output .= '<tr>
                <td>'.$row->name.'</td></tr>';
            }
        }
        else{
            $output .= '<tr><td colspan="4">No data found</td></tr>';
        }

        $output .= '</table>';
        echo $output;
    }

    /**
     * Search user dynamically
     */
    public function searchUser(){

        $limit = 10;
        $page = 1;

        if($_POST['page'] > 1){
            $start = (($_POST['page']-1) * $limit);
            $page = $_POST['page'];
        }else{
            $start = 0;
        }

        $results = User::liveSearch($start,$limit);
        $total_data = User::liveSearchCount();

        $output = '<label>Total Records - '.$total_data.'</label>
            <table class="table table-striped table-bordered">
                <tr>
                    <th>id</th>
                    <th>first name</th>
                    <th>last name</th>                   
                    <th>mobile</th>
                    <th>email</th> 
                    <th>active</th>                                        
                    <th>course</th>                    
                    <th>edit</th></tr>';

        if($total_data > 0){

            foreach($results as $row){
                $output .= '<tr>
                <td>'.$row->id.'</td>
                <td>'.$row->first_name.'</td>
                <td>'.$row->last_name.'</td>                
                <td>'.$row->mobile.'</td>
                <td>'.$row->email.'</td>
                <td>'.$row->is_active.'</td>
                <td><button onclick="getUserCourseInfo('.$row->id.')" type="button" class="mb-1 btn btn-sm btn-success">View</button></td>
                <td><button onclick="getContentInfo('.$row->id.')" type="button" class="mb-1 btn btn-sm btn-info">Edit</button></td>
                </tr>';
            }

        }
        else{

            $output .= '<tr><td colspan="4">No data found</td></tr>';

        }

        $output .= '</table></br>
            <div align="center">
                <ul class="pagination">
        ';

        $total_links = ceil($total_data/$limit);
        $previous_link = '';
        $next_link = '';
        $page_link ='';

        if($total_links > 4){
            if($page<5){
                for($count=1; $count<=5; $count++){

                    $page_array[]=$count;
                }
                $page_array[]='...';
                $page_array[]=$total_links;
            }else{
                $end_limit = $total_links - 5 ;
                if($page > $end_limit){

                    $page_array[] = 1;
                    $page_array[] = '...';

                    for($count=$end_limit; $count<=$total_links; $count++){
                        $page_array[]=$count;
                    }
                }else{
                    $page_array[]=1;
                    $page_array[]='...';
                    for($count = $page-1; $count<=$page+1; $count++){
                        $page_array[]=$count;
                    }
                    $page_array[]=1;
                    $page_array[]=$total_links;
                }
            }
        }
        else{
            for($count=1; $count <= $total_links; $count++){
                $page_array[] = $count;
            }
        }
        // checked

        for($count = 0; $count < count($page_array); $count++)
        {
            if($page == $page_array[$count])
            {
                $page_link .= '<li class="page-item active">
                      <a class="page-link" href="#">'.$page_array[$count].' <span class="sr-only">(current)</span></a>
                    </li>
                    ';

                $previous_id = $page_array[$count] - 1;
                if($previous_id > 0)
                {
                    $previous_link = '<li class="page-item"><a class="page-link" href="javascript:void(0)" data-page_number="'.$previous_id.'">Previous</a></li>';
                }
                else
                {
                    $previous_link = '<li class="page-item disabled">
                        <a class="page-link" href="#">Previous</a>
                      </li>
                      ';
                }
                $next_id = $page_array[$count] + 1;
                if($next_id >= $total_links)
                {
                    $next_link = '<li class="page-item disabled">
                        <a class="page-link" href="#">Next</a>
                      </li>';
                }
                else
                {
                    $next_link = '<li class="page-item"><a class="page-link" href="javascript:void(0)" data-page_number="'.$next_id.'">Next</a></li>';
                }
            }
            else
            {
                if($page_array[$count] == '...')
                {
                    $page_link .= '
                      <li class="page-item disabled">
                          <a class="page-link" href="#">...</a>
                      </li>
                      ';
                }
                else
                {
                    $page_link .= '<li class="page-item"><a class="page-link" href="javascript:void(0)" 
                    data-page_number="'.$page_array[$count].'">'.$page_array[$count].'</a></li>';
                }
            }
        }

        $output .= $previous_link . $page_link . $next_link;
        $output .= '</ul></div>';

        echo $output;
    }
    /* *** */

    /* ==================================================================
     * Payment Order: Ajax 1 Functions Bundle
     * Used in payment_orders view
     * ====================================================================
     * */
    public function searchOrder(){

        $limit = 10;
        $page = 1;

        if($_POST['page'] > 1){
            $start = (($_POST['page']-1) * $limit);
            $page = $_POST['page'];
        }else{
            $start = 0;
        }

        $results = Order::liveSearch($start,$limit);
        $total_data = Order::liveSearchCount();

        $output = '<label>Total Records - '.$total_data.'</label>
            <table class="table table-striped table-bordered">
                <tr>
                    <th>id</th>
                    <th>order no</th>
                    <th>amount</th>                   
                    <th>status</th>
                    <th>message</th>    
                    <th>user</th>                 
                    <th>dated</th>                    
                </tr>';

        if($total_data > 0){

            foreach($results as $row){
                $output .= '<tr>
                <td>'.$row->id.'</td>
                <td>'.$row->order_id.'</td>
                <td>'.$row->amount.'</td>                
                <td>'.$row->status.'</td>
                <td>'.$row->resp_msg.'</td>
                <td>'.$row->user_id.'</td>
                <td>'.$row->created_at.'</td>
                </tr>';
            }

        }
        else{

            $output .= '<tr><td colspan="4">No data found</td></tr>';

        }

        $output .= '</table></br>
            <div align="center">
                <ul class="pagination">
        ';

        $total_links = ceil($total_data/$limit);
        $previous_link = '';
        $next_link = '';
        $page_link ='';

        if($total_links > 4){
            if($page<5){
                for($count=1; $count<=5; $count++){

                    $page_array[]=$count;
                }
                $page_array[]='...';
                $page_array[]=$total_links;
            }else{
                $end_limit = $total_links - 5 ;
                if($page > $end_limit){

                    $page_array[] = 1;
                    $page_array[] = '...';

                    for($count=$end_limit; $count<=$total_links; $count++){
                        $page_array[]=$count;
                    }
                }else{
                    $page_array[]=1;
                    $page_array[]='...';
                    for($count = $page-1; $count<=$page+1; $count++){
                        $page_array[]=$count;
                    }
                    $page_array[]=1;
                    $page_array[]=$total_links;
                }
            }
        }
        else{
            for($count=1; $count <= $total_links; $count++){
                $page_array[] = $count;
            }
        }
        // checked

        for($count = 0; $count < count($page_array); $count++)
        {
            if($page == $page_array[$count])
            {
                $page_link .= '<li class="page-item active">
                      <a class="page-link" href="#">'.$page_array[$count].' <span class="sr-only">(current)</span></a>
                    </li>
                    ';

                $previous_id = $page_array[$count] - 1;
                if($previous_id > 0)
                {
                    $previous_link = '<li class="page-item"><a class="page-link" href="javascript:void(0)" data-page_number="'.$previous_id.'">Previous</a></li>';
                }
                else
                {
                    $previous_link = '<li class="page-item disabled">
                        <a class="page-link" href="#">Previous</a>
                      </li>
                      ';
                }
                $next_id = $page_array[$count] + 1;
                if($next_id >= $total_links)
                {
                    $next_link = '<li class="page-item disabled">
                        <a class="page-link" href="#">Next</a>
                      </li>';
                }
                else
                {
                    $next_link = '<li class="page-item"><a class="page-link" href="javascript:void(0)" data-page_number="'.$next_id.'">Next</a></li>';
                }
            }
            else
            {
                if($page_array[$count] == '...')
                {
                    $page_link .= '
                      <li class="page-item disabled">
                          <a class="page-link" href="#">...</a>
                      </li>
                      ';
                }
                else
                {
                    $page_link .= '<li class="page-item"><a class="page-link" href="javascript:void(0)" 
                    data-page_number="'.$page_array[$count].'">'.$page_array[$count].'</a></li>';
                }
            }
        }

        $output .= $previous_link . $page_link . $next_link;
        $output .= '</ul></div>';

        echo $output;

    }
    /* *** */


    /* ==================================================================
     * Unattached Files : Ajax 2 Functions Bundle
     * Used in list_files view
     * ====================================================================
     * */
    /**
     * Fetch unattached files
     */
    public function fetchFileRecords(){

        if(isset($_POST['readrecord'])){
            $data = '<table class="table table-bordered">
                <thead>
                <tr>
                    <th scope="col">Id</th>
                    <th scope="col">Name</th>                   
                    <th scope="col">Delete</th>                    
                           
                </tr></thead><tbody>';

            $results = File::fetchAllUnattached();
            $num = count($results);

            if($num>0){
                foreach($results as $row) {
                    $data .= '<tr>
                    <td>'.$row['id'].'</td>
                    <td>'.$row['name'].'</td>                                               
                    <td><button onclick="deleteFileInfo('.$row['id'].')" type="button" class="mb-1 btn btn-sm btn-danger">Del</button></td>                   
                </tr>';
                }
            }

            $data .='</tbody></table>';
            echo $data;

        }
    }

    /**
     *  Delete unattached file
     */
    public function deleteFileRecord(){

        if(isset($_POST['id'])){

            $re = File::deleteRecord($_POST['id']);
            if(!$re){
                echo 'Something went Wrong';
            }
            echo 'Deleted File Permanently';

        }

    }

    /**
     * Search user dynamically
     */
    public function searchStudent(){

        $limit = 10;
        $page = 1;

        if($_POST['page'] > 1){
            $start = (($_POST['page']-1) * $limit);
            $page = $_POST['page'];
        }else{
            $start = 0;
        }

        $results = Student::liveSearch($start,$limit);
        $total_data = Student::liveSearchCount();

        $output = '<label>Total Records - '.$total_data.'</label>
            <table class="table table-striped table-bordered">
                <tr>
                    <th>id</th>
                    <th>name</th>                                       
                    <th>mobile</th>
                    <th>email</th> 
                    <th>Student</th>                                                                        
                    <th>Courses</th>                                                                        
                    <th>Fees</th></tr>';

        if($total_data > 0){

            foreach($results as $row){
                $output .= '<tr>
                <td>'.$row->id.'</td>
                <td>'.$row->first_name.' '.$row->last_name.'</td>                            
                <td>'.$row->mobile.'</td>
                <td>'.$row->email.'</td>
                <td>
                <button onclick="getStudentDetails('.$row->id.')" type="button" class="mb-1 btn btn-sm btn-info">View</button>
                <button onclick="getStudentInfo('.$row->id.')" type="button" class="mb-1 btn btn-sm btn-secondary">Edit</button>
                </td>
                <td>
                <button onclick="showEnrollmentForm('.$row->id.')" type="button" class="mb-1 btn btn-sm btn-primary">Enroll</button>
                <button onclick="getEnrollmentInfo('.$row->id.')" type="button" class="mb-1 btn btn-sm btn-warning">View</button>
                </td>               
                <td><button onclick="getUserCourseInfo('.$row->id.')" type="button" class="mb-1 btn btn-sm btn-success">Deposit</button></td>
                </tr>';
            }

        }
        else{

            $output .= '<tr><td colspan="4">No data found</td></tr>';

        }

        $output .= '</table></br>
            <div align="center">
                <ul class="pagination">
        ';

        $total_links = ceil($total_data/$limit);
        $previous_link = '';
        $next_link = '';
        $page_link ='';


        if($total_links > 4){
            if($page<5){
                for($count=1; $count<=5; $count++){

                    $page_array[]=$count;
                }
                $page_array[]='...';
                $page_array[]=$total_links;
            }else{
                $end_limit = $total_links - 5 ;
                if($page > $end_limit){

                    $page_array[] = 1;
                    $page_array[] = '...';

                    for($count=$end_limit; $count<=$total_links; $count++){
                        $page_array[]=$count;
                    }
                }else{
                    $page_array[]=1;
                    $page_array[]='...';
                    for($count = $page-1; $count<=$page+1; $count++){
                        $page_array[]=$count;
                    }
                    $page_array[]=1;
                    $page_array[]=$total_links;
                }
            }
        }
        else{
            for($count=1; $count <= $total_links; $count++){
                $page_array[] = $count;
            }
        }
        // checked
        $page_array[]=0;
        for($count = 0; $count < count($page_array); $count++)
        {
            if($page == $page_array[$count])
            {
                $page_link .= '<li class="page-item active">
                      <a class="page-link" href="#">'.$page_array[$count].' <span class="sr-only">(current)</span></a>
                    </li>
                    ';

                $previous_id = $page_array[$count] - 1;
                if($previous_id > 0)
                {
                    $previous_link = '<li class="page-item"><a class="page-link" href="javascript:void(0)" data-page_number="'.$previous_id.'">Previous</a></li>';
                }
                else
                {
                    $previous_link = '<li class="page-item disabled">
                        <a class="page-link" href="#">Previous</a>
                      </li>
                      ';
                }
                $next_id = $page_array[$count] + 1;
                if($next_id >= $total_links)
                {
                    $next_link = '<li class="page-item disabled">
                        <a class="page-link" href="#">Next</a>
                      </li>';
                }
                else
                {
                    $next_link = '<li class="page-item"><a class="page-link" href="javascript:void(0)" data-page_number="'.$next_id.'">Next</a></li>';
                }
            }
            else
            {
                if($page_array[$count] == '...')
                {
                    $page_link .= '
                      <li class="page-item disabled">
                          <a class="page-link" href="#">...</a>
                      </li>
                      ';
                }
                else
                {
                    $page_link .= '<li class="page-item"><a class="page-link" href="javascript:void(0)" 
                    data-page_number="'.$page_array[$count].'">'.$page_array[$count].'</a></li>';
                }
            }
        }

        $output .= $previous_link . $page_link . $next_link;
        $output .= '</ul></div>';

        echo $output;
    }

    /**
     *  Fetch group
     */
    public function fetchThisStudentDetails(){

        if(isset($_POST['studentId']) && isset($_POST['studentId'])!=''){

            $student_id = $_POST['studentId'];
            $studentInfo = Student::fetchComplete($student_id);
            $num = count($studentInfo);
            if($num>0){
                $response = $studentInfo;
            }else{
                $response['status']=200;
                $response['message']="No data found!";
            }
            echo json_encode($response);

        }
    }

    /**
     *  Fetch group
     */
    public function fetchSingleStudentRecord(){

        if(isset($_POST['userId']) && isset($_POST['userId'])!=''){

            $user_id = $_POST['userId'];
            $userInfo = Student::fetch($user_id);
            $num = count($userInfo);
            if($num>0){
                $response = $userInfo;
            }else{
                $response['status']=200;
                $response['message']="No data found!";
            }
            echo json_encode($response);

        }
    }

    /**
     * Update group
     */
    public function updateSingleStudentRecord(){

        if(isset($_POST['id']) && $_POST['id']!=''){

            $re = Student::update($_POST);
            if($re){
                echo 'Student Info Updated';
            }else{
                echo 'Something went Wrong';
            }
        }
    }

    /**
     * Add new group
     */
    public function insertNewEnrollmentRecord(){

        if(isset($_POST['userId']) && $_POST['userId']>=0){

            $re = Student::enroll($_POST);
            if(!$re){
                echo 'Please fill all the fields correctly';
            }
            echo 'New Student Account Created';

        }
    }

    public function enrollmentInfo(){

        $id = $_POST['userId'];

        $info = Student::getAllEnrolls($id);

        $total_data = count($info);

        $output = '<div>';

        if($total_data>0){

            foreach($info as $inf){
                $output .= '<ul class="list-group">
                        <li class="list-group-item list-group-item-warning" >Course: <i><u>'.$inf->name.'</u></i></li>
                        <li class="list-group-item">Degree: <i><u>'.$inf->short.'</u></i></li>
                        <li class="list-group-item">Enroll no: <i><u>'.$inf->enroll_no.'</u></i></li>
                    </ul><br>';
            }

        }else{
            $output .= '<ul class="list-group">
                    <li class="list-group-item">No record found</li>
                    </ul>';
        }

        $output .= '</div>';


        echo $output;
    }


}