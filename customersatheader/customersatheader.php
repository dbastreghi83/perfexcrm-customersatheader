<?php

defined('BASEPATH') or exit('No direct script access allowed');

/*
Module Name: Customers at Header
Description: Adds a customers list shortcut at admin header
Version: 1.0
Requires at least: 2.3.*
*/

hooks()->add_action('after_render_top_search','customersatheader_load');

function customersatheader_load(){
    if (is_admin()){
        $CI = &get_instance();

        $sql = 'SELECT userid, company FROM `'.db_prefix().'clients` WHERE active = 1 ORDER BY company ASC';
        
        #$this -> printr($sql);
        $rs = $CI->db->query($sql);
        $rs_array = $rs -> result_array();
        
        if (!count($rs_array)) return false;
        $html = '<div id="customersatheader" style="display: inline-block; margin: 20px; max-width: 150px;"><select name="customersatheader_selector" id="customersatheader_selector" style="width: 99%;" onchange="window.location = \'/admin/clients/client/\'+this.value">';
        $html .= '<option value="">Go to customer...</option>';
        foreach ($rs_array as $c) $html .= '<option value="'.$c['userid'].'">'.$c['company'].'</option>';
        $html .= '</select></div>';
        
        echo $html;
    }
}