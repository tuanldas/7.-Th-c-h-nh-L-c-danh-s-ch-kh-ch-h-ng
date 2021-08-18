<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
</head>
<body>
<style>
    table {
        border-collapse: collapse;
        width: 100%;
    }

    th, td {
        padding: 8px;
        text-align: left;
        border-bottom: 1px solid #ddd;
    }

    #from, #to {
        width: 200px;
        border: 2px solid #ccc;
        border-radius: 4px;
        font-size: 16px;
        padding: 12px 10px 12px 10px;
    }

    #submit {
        border-radius: 2px;
        padding: 10px 32px;
        font-size: 16px;
    }

    .profile {
        height: 60px;
        width: 80px;
        overflow: hidden;
    }

    .profile img {
        width: 100%;
    }
</style>
<?php
require_once 'aray.php';
require_once 'function.php';
$from_date = NULL;
$to_date = NULL;
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $from_date = $_POST["from"];
    $to_date = $_POST["to"];
}
$filtered_customers = searchByDate($customerList, $from_date, $to_date);
?>
<form method="post" style="text-align: center">
    Từ: <input id="from" type="text" name="from" placeholder="yyyyy/mm/dd"
               value="<?php echo isset($from_date) ? $from_date : ''; ?>"/>
    Đến: <input id="to" type="text" name="to" placeholder="yyyy/mm/dd"
                value="<?php echo isset($to_date) ? $to_date : ''; ?>"/>
    <input type="submit" id="submit" value="Lọc"/>
</form>

<table border="0">
    <caption><h2>Danh sách khách hàng</h2></caption>
    <tr>
        <th>STT</th>
        <th>Tên</th>
        <th>Ngày sinh</th>
        <th>Địa chỉ</th>
        <th>Ảnh</th>
    </tr>
    <?php if (count($filtered_customers) === 0): ?>
        <tr>
            <td>Không tìm thấy khách hàng nào</td>
        </tr>
    <?php endif; ?>

    <?php foreach ($filtered_customers as $index => $customers): ?>
        <tr>
            <td><?php echo $index + 1; ?></td>
            <td><?php echo $customers['name']; ?></td>
            <td><?php echo $customers['day_of_birth']; ?></td>
            <td><?php echo $customers['address']; ?></td>
            <td>
                <div class="profile"><img src="<?php echo $customers['profile']; ?>"/></div>
            </td>
        </tr>
    <?php endforeach; ?>
</table>
</body>
</html>