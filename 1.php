<?php
echo $undefined_variable;
trigger_error("This is a custom error!", E_USER_ERROR);
?>