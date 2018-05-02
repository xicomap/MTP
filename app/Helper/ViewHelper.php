<?php

use App\PromocodeUsage;
use App\ServiceType;

function dropdown($name, $arr, $value = '')
{   
        $str = '<select id="'.$name.'" class="form-control" name="'.$name.'" required>';
        $str .= '<option value="">Select</option>';
        if (count($arr)>0)
        {
            foreach ($arr as $dp)
            {
                $str .= '<option value="'.$dp['id'].'" '. (($value == $dp['id']) ? 'selected' : '') . '>'.$dp['name'].'</option>';           
            }
        }
        $str .= '</select>';
        return $str;
}

function dropdown2($name, $arr, $value = '')
{
    $str = '<select id="'.$name.'" class="form-control" name="'.$name.'" required>';
    $str .= '<option value="">Select</option>';
    if (count($arr)>0)
    {
        foreach ($arr as $dp)
        {
            $str .= '<option value="'.$dp['name'].'" '. (($value == $dp['name']) ? 'selected' : '') . '>'.$dp['name'].'</option>';
        }
    }
    $str .= '</select>';
    return $str;
}

function branchNameDropDown($value)
{
    $str = '<select id="org_type" class="form-control" name="org_type">';
    $str .= '<option value="">Select</option>';
    $str .= '<option value="Web graphic designer" '. (($value == "Web graphic designer") ? 'selected' : '') . '>Web graphic designer</option>';
    $str .= '<option value="Developer" '. (($value == "Developer") ? 'selected' : '') . '>Developer</option>';
    $str .= '<option value="SEO" '. (($value == "SEO") ? 'selected' : '') . '>SEO</option>';
    $str .= '<option value="Bidder" '. (($value == "Bidder") ? 'selected' : '') . '>Bidder</option>';
    $str .= '</select>';
    return $str;  
}

function userTypeDropdown($value = '')
{
    $str = '<select id="UserType" class="form-control" name="user_type" required>';
    $str .= '<option value="">Select</option>';
    $str .= '<option value="1" '. (($value == 1) ? 'selected' : '') . '>Competitor</option>';
    $str .= '<option value="2" '. (($value == 2) ? 'selected' : '') . '>Sponsor</option>';
    $str .= '<option value="3" '. (($value == 3) ? 'selected' : '') . '>Investor</option>';
    $str .= '<option value="4" '. (($value == 4) ? 'selected' : '') . '>METEC Employees</option>';
    $str .= '<option value="5" '. (($value == 5) ? 'selected' : '') . '>Mlt Employees</option>';
    $str .= '<option value="6" '. (($value == 6) ? 'selected' : '') . '>Documentation User</option>';
    $str .= '</select>';
    return $str;
}

function roleTypeDropdown($value = '')
{
    $str = '<select id="RoleId" class="form-control" name="role_id" required>';
    $str .= '<option value="">Select</option>';
    $str .= '<option value="2" '. (($value == 2) ? 'selected' : '') . '>Innovation Admin</option>';
    $str .= '<option value="3" '. (($value == 3) ? 'selected' : '') . '>MLT Admin</option>';
    $str .= '<option value="4" '. (($value == 4) ? 'selected' : '') . '>Documentation Admin</option>';
    $str .= '<option value="5" '. (($value == 5) ? 'selected' : '') . '>Marketing Admin</option>';
    $str .= '</select>';
    return $str;
}

function userType($value = '')
{
	if ($value == 1)
	    return "Competitors";
	else if ($value == 2)
	    return "Sponsors";
	else if ($value == 3)
	       return "Investors";
	else if ($value == 4)
	    return "METEC Employees";
	else if ($value == 5)
	     return "MLT Employees";
	else if ($value == 6)
	     return "Documentation User";
	else 
	    return '';
}

function roleType($value = '')
{
    if ($value == 2)
        return "Innovation Admin";
    else if ($value == 3)
        return "MLT Admin";
    else if ($value == 4)
        return "Documentation Admin";
    else if ($value == 5)
        return "Marketing Admin";
    else
        return '';
}

function getMetecPostStatus($value = '')
{
    if ($value == 0)
        return "Waiting";
    else if ($value == 1)
        return "Approve";
    else if ($value == 2)
        return "Decline";
    else if ($value == 3)
        return "Hide";
    else
        return '';
}

function getChallengeName($value)
{
    if ($value == 1)
        return "Idea Competition";
    else if ($value == 2)
        return "Public Challenge";
    else if ($value == 3)
        return "METEC Challenge";   
    else if ($value == 4)
        return "Military Challenge";       
    else
        return '';
}

function getManualName($value)
{
    if ($value == 1)
        return "MLT Manual";      
    if ($value == 2)
        return "Product Manual";        
    if ($value == 1)
        return "Industry Manual";        
    else
        return '';
}

function img($img){
	if($img == ""){
		return asset('main/avatar.jpg');
	}else if (strpos($img, 'http') !== false) {
        return $img;
    }else{
		return asset('storage/'.$img);
	}
}

function image($img){
	if($img == ""){
		return asset('main/avatar.jpg');
	}else{
		return asset($img);
	}
}

function originalDate($date)
{
    if ($date != "") {
        $dt = explode('-',$date);
        return $dt[1]."-".$dt[2]."-".$dt[0];
    }
    return '';
}

function ideaStatusName($value)
{
    if ($value == 0)
        return "Waiting";
    else if ($value == 1)
        return "Approved";
    else if ($value == 2)
        return "Decline";
    else
        return '';
}

