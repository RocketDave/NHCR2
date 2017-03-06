<?php
require_once('includes/Project.php');

if (empty($_POST['user_id']) || empty($_POST['password'])) {
    $_SESSION['ERRORS'] = " Please enter a Username and Password. <br/>";
}

$instances = array(
        'biodev3.dartmouth.edu' => array(
           #     'engine' => 'ddev11w',
                'host' => 'bronzepg92.evergreen3.dartmouth.edu'),
        'biotest3.dartmouth.edu' => array(
            #    'engine' => 'dtest11w',
                'host' => 'silverpg92.evergreen3.dartmouth.edu'),
        'tesla.dartmouth.edu' => array(
             #   'engine' => 'dprod11w',
                'host' => 'goldpg92.evergreen3.dartmouth.edu'),
        'bio-epi.dartmouth.edu' => array(
              #  'engine' => 'dprod11w',
                'host' => 'goldpg92.evergreen3.dartmouth.edu')
);

$dbname = 'NHCR2';
$instance = $instances[$_SERVER['SERVER_NAME']];
#$engine = $instance['engine'];
$host = $instance['host'];
$conn = pg_connect(' user='.$_POST['user_id'].' password='.$_POST['password'].' dbname='.$dbname.' host='.$host);


if (!$conn) {
    $_SESSION['ERRORS'] = "Username or Password is invalid. ".pg_last_error($conn);
    header('Location: Login.php');
}    else    {
        unset($_SESSION['ERRORS']); /* no errors, variable no longer needed    */
        error_log($_POST['user_id'],0);
        $_SESSION['user_id'] = $_POST['user_id'];
        $_SESSION['password'] = $_POST['password'];
        $_SESSION['db_name'] = $dbname;
        $_SESSION['db_host'] =$host;
        $_SESSION['expiration'] = time() + 7200;
        $_SESSION['previous_location'] = 'dashboard.php';
        header('Location:enabled.php');
        $result = pg_query($conn,'select public.get_user_groups();');
        if(!$result || $result == 0)    {
            $_SESSION['ERRORS'] = "At get_user_groups: ".pg_last_error($conn);
            header('Location: Login.php');
        }    else    {
                $roles = pg_fetch_array($result);
                # Two elements are returned: one with element indexed [0], one with element named "[get_user_groups]"
                # Both are a comma delimited string of all the roles (including nested); break out first elem as an array
                $role_array = explode(',', $roles[0]);
                $_SESSION['user_role_array'] = $role_array;
                pg_free_result($result);
            if($role_array == '')    {
                $_SESSION['ERRORS'] = "There was a problem logging you on: Username/Password not found. ".pg_last_error($conn);
                header('Location: Login.php');
            }    else    {
                $_SESSION['expiration'] = time() + 7200;
                header('Location:Dashboard.php');    
            }
        }
    }
pg_close($conn);
?>
