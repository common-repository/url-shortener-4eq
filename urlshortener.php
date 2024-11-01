<?php
/*
Plugin Name:url Shortener 4eq
Description:after installed this plugin and Place [us4eq] in your pages  a form is created on that page so that you or your site visitors can shorten their links url shortener tool introduced by 4eq.ir.
Author: saeed mohammadi
Version: 0.1
*/ 

/**** shorten url PHP Function ***/
function shorten_us4eq($url) {
$response = wp_remote_get("http://4eq.ir/updaterkhodam.php?url=".$url );
if ( is_array( $response ) ) {
  $header = $response['headers']; // array of http header lines
  $body = $response['body']; // use the content
}
return $body;
}
/**** validate_url PHP Function  ***/

function validate_url_us4eq($url) {
    $path = parse_url($url, PHP_URL_PATH);
    $encoded_path = array_map('urlencode', explode('/', $path));
    $url = str_replace($path, implode('/', $encoded_path), $url);

    return filter_var($url, FILTER_VALIDATE_URL) ? true : false;
}




add_action('admin_menu', 'test_plugin_setup_menu_us4eq');

function test_plugin_setup_menu_us4eq(){
add_menu_page( 'us4eq Plugin Page', 'url shortener 4eq', 'manage_options', 'us4eq-plugin', 'test_init_us4eq' );
}

function test_init_us4eq(){
echo '    <div class="part-lead">
        <h1>url shortener and Link Shortener form for your website 4eq</h1>
        <p class="lead"> for use Place [us4eq] in your pages
Social media plugin which let’s you powerful, extremely scalable and light weight url shortener tool introduced by 4eq.ir.        <br><br>
        </p>
    </div>';
}
 function joomir_addform_us4eq( $atts ) {
// code


$nonce = $_REQUEST['nonce_us4eq'];
if ( ! wp_verify_nonce( $nonce, 'my-nonce_us4eq' ) ) {
    // This nonce is not valid.
  ///  die( __( 'Security check', 'textdomain' ) ); 
} else {
    // The nonce was valid.
    // Do stuff here.


if(isset($_POST["name_us4eq"])){
    
    
$actual_link =esc_url( $_POST["name_us4eq"]);

if(!validate_url_us4eq($actual_link)) {
    $message="IS NOT A URL";
}
else {
$message=" succesfull ";
$ur=shorten_us4eq("$actual_link");
$ur=json_encode($ur);
$ur=explode('_',$ur);
$ur=explode('\\\/',$ur[1]);
$ur=implode('/',$ur);
$ur=explode('\/',$ur);
$ur=implode('/',$ur);
$ur=explode('\/',$ur);
$ur=implode('/',$ur);
$ur=urlencode($ur);
$ur=explode('%5C',$ur);
$ur=implode('',$ur);
$actual_link_back=urldecode($ur);
}


}
else{
$actual_link="";  
$message="";
 $actual_link_back="" ;  
}


}
wp_enqueue_style('style-name_us4eq', plugins_url('/css1.css', __FILE__));


echo'
<header>
    <h1>URL Shortener'.$message.'
</h1>
</header>

<div id="form_us4eq">

<div class="fish_us4eq" id="fish_us4eq"></div>
<div class="fish_us4eq" id="fish_us4eq2"></div>

<form id="waterform_us4eq" method="POST">

<div class="formgroup_us4eq" id="name-form_us4eq">
    <label for="name_us4eq">paste a long url*</label>
    <input type="text" id="name_us4eq" name="name_us4eq" value="'.$actual_link.'"/>
</div>

<div class="formgroup_us4eq" id="email-form_us4eq">
    <label for="email_us4eq">Your shorte url*</label>
    <input readonly type="text" id="email_us4eq" name="email_us4eq" value="'.$actual_link_back.'" />
</div>
 <input type="hidden" id="nonce_us4eq" name="nonce_us4eq" value="'.wp_create_nonce( 'my-nonce_us4eq' ).'">

    <input type="submit" value="shorten!" />
</form>
</div>
';

}
add_shortcode( 'us4eq', 'joomir_addform_us4eq' );
?>