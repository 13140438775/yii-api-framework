<?php
/**
 * exception email template
 */
?>
<h2>Request Info</h2>
<table border="1" cellpadding="0" cellspacing="0">
    <tr>
        <th>request_time</th>
        <th><?php echo date('Y-m-d H:i:s'); ?></th>
    </tr>
    <tr>
        <th>request_url</th>
        <th><?php echo $request_info['path_info']; ?></th>
    </tr>
    <tr>
        <th>request_method</th>
        <th><?php echo $request_info['method']; ?></th>
    </tr>
    <tr>
        <th>get</th>
        <th>
            <?php echo json_encode($request_info['get']); ?>
        </th>
    </tr>
    <tr>
        <th>post</th>
        <th>
            <?php echo json_encode($request_info['post']); ?>
        </th>
    </tr>
    <tr>
        <th>header</th>
        <th>
            <?php echo json_encode($request_info['header']); ?>
        </th>
    </tr>
</table>
<?php
if (!isset($error_code)) {
    return;
}
?>
<h2>Exception Info</h2>
<table border="1" cellpadding="0" cellspacing="0">
    <tr>
        <th>error_code</th>
        <th><?php echo $error_code; ?></th>
    </tr>
    <tr>
        <th>error_file</th>
        <th><?php echo $error_file; ?></th>
    </tr>
    <tr>
        <th>error_line</th>
        <th><?php echo $error_line; ?></th>
    </tr>
    <tr>
        <th>error_msg</th>
        <th><b><?php echo $error_msg; ?></b></th>
    </tr>
    <tr>
        <th>error_trace</th>
        <th>
            <ul>
                <?php foreach ($error_trace as $v) { ?>
                    <li style="list-style-type:none;"><?php echo $v; ?></li>
                <?php } ?>
            </ul>
        </th>
    </tr>
</table>
