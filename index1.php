<?php

$customer_list = array(
    "1" => array("Name" => "Cristiano Ronaldo",
        "Birthday" => "1983-08-20",
        "Address" => "Portugal",
        "Image" => "img/cristiano-ronaldo.jpg"),
    "2" => array("Name" => "Neymar Jr",
        "Birthday" => "1983-08-20",
        "Address" => "Brazil",
        "Image" => "img/neymar jr.jpg"),
    "3" => array("Name" => "Lionen Messi",
        "Birthday" => "1983-08-21",
        "Address" => "Arghentinal",
        "Image" => "img/Messi-The-Best.jpg"),
    "4" => array("Name" => "Fernando Torres",
        "Birthday" => "1983-08-22",
        "Address" => "Spain",
        "Image" => "img/Fernando-Torres-Liverpool.jpg"),
    "5" => array("Name" => "Steven Gerrard",
        "Birthday" => "1983-08-17",
        "Address" => "England",
        "Image" => "img/gerrard.jpg")
);

function searchByDate($customers, $from_date, $to_date)
{
    if (empty($from_date) && empty($to_date)) {
        return $customers;
    }
    $filtered_customers = [];
    foreach ($customers as $customer) {
        if (!empty($from_date) && (strtotime($customer['Birthday']) < strtotime($from_date)))
            continue;
        if (!empty($to_date) && (strtotime($customer['Birthday']) > strtotime($to_date)))
            continue;
        $filtered_customers[] = $customer;
    }
    return $filtered_customers;
}

?>

<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <link type="text/css" rel="stylesheet" href="css/style.css"/>
</head>
<style>

    table {
        border-collapse: collapse;
        width: 100%;
    }

    th, td {
        padding: 8px;
        text-align: left;
        border-bottom: 1px solid green;
    }

    .thumbnail {
        height: 60px;
        width: 100px;
        overflow: hidden;
    }

    .thumbnail img {
        width: 100%;
    }

</style>
<body>

<?php

$from_date = NULL;
$to_date = NULL;
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $from_date = $_POST["from"];
    $to_date = $_POST["to"];
}
$filtered_customers = searchByDate($customer_list, $from_date, $to_date);

?>

<form method="post">
    Từ: <input id="from" type="text" name="from" placeholder="yyyyy/mm/dd"
               value="<?php echo isset($from_date) ? $from_date : ''; ?>"/>
    Đến: <input id="to" type="text" name="to" placeholder="yyyy/mm/dd"
                value="<?php echo isset($to_date) ? $to_date : ''; ?>"/>
    <input type="submit" id="submit" value="Find"/>
</form>

<table border="0">

    <caption><h2>List Of Customer</h2></caption>

    <tr>
        <th>STT</th>
        <th>Name</th>
        <th>Birthday</th>
        <th>Address</th>
        <th>Image</th>
    </tr>

    <?php foreach ($filtered_customers as $index => $customer): ?>

        <tr>
            <td><?php echo $index + 1; ?></td>
            <td><?php echo $customer['Name']; ?></td>
            <td><?php echo $customer['Birthday']; ?></td>
            <td><?php echo $customer['Address']; ?></td>
            <td>
                <div class="thumbnail"><img src="<?php echo $customer['Image']; ?>"/></div>
            </td>
        </tr>

    <?php endforeach; ?>

</table>
</body>
</html>