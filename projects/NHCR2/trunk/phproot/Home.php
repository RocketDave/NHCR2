<?php
require_once('includes/Project.php');

$display_for_informatics = FALSE;
$display_for_staff = FALSE;
$go_to_RC_Dashboard = FALSE;
$form_name = 'Home Page';

if (isset($_SESSION['password'])) {
    $session->check_session($session->home_page);
    try {
        $session->db_reconnect();
        $display_for_informatics = FALSE;
        $display_for_PI = FALSE;
        $display_for_rc = FALSE;
        if(!in_array('nhcr2_staff', $_SESSION['user_role_array'])) {
            $_SESSION['ERRORS'] = 'You are not an authorized user of this site.';
            header('Location: Logout.php');
        }
        if(in_array('nhcr2_informatics', $_SESSION['user_role_array'])) {
            $display_for_informatics = TRUE;
        }
        if(in_array('nhcr2_rc', $_SESSION['user_role_array'])) {
            $display_for_rc = TRUE;
        }
    }
    catch (Exception $e) {
        $session->info['message'] = $e->getMessage();
    }
}


?>
<!DOCTYPE HTML>
<html>
<body>
<div id="page_wrapper">
<div class="content">
<?php
if (!isset($_SESSION['password'])) {
    require_once('Login.php');
}else {
    if ($display_for_rc) {
        $form = $session->script_path() . 'Dashboard.php';
        if (isset($session->info['message'])) {
            $session->browser_redirect($form, array('message' => $session->info['message']));
        }
        else {
        $session->browser_redirect($form);
        }
    }
}    // end session password found
?>

<table align="center" width="60%" border="0" style="boarder-spacing:10px;" class="NormalBlack">
    <tr><td align="center">    &nbsp;</td></tr>
    <tr><td>&nbsp;</td></tr>
    <?php
    if (!isset($_SESSION['password'])) {
    ?>
    <tr>
        <td style="text-align:left;padding-left:4em;margin-top:.7em;">
            Having problems with this website?
        </td>
    </tr>
    <tr>
        <td style="text-align:left;padding-left:4em;margin-top:.7em;">
            <script language=javascript>
                //<!--
                var contact = "Link for E-mail Help at Dartmouth"
                var email = "NHCR2"
                var emailHost = "dartmouth.edu"
                document.write("<a href=" + "mail" + "to:" + email + "@" + emailHost+ ">" + contact + "</a>")
                //-->
            </script>
        </td>
    </tr>
    <?php
    }
    ?>
    <tr><td>&nbsp;</td></tr>
    <tr>
        <td align="center" >&nbsp;<br /></td>
    </tr>
    <tr>
        <td style="text-align:left;padding-left:4em;font-size:small;right-margin:float;">UNAUTHORIZED ACCESS IS PROHIBITED: Unauthorized access to this web site and the data contained is strictly prohibited.<br />All access and attempts to access this web site are monitored and logged. Use of this system acknowledges you are consenting to these conditions.
        </td>
    </tr>
    <tr>
        <td style="text-align:center"><?php include("includes/Footer.php"); ?><br /></td>
    </tr>
</table>
</div> <!-- end page_wrapper  -->
</body>
</html>
