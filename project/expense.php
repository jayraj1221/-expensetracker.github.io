<?php
include('header.php');
checkUser();
userArea();

$label = "Add";
if (isset($_GET['id']) && $_GET['id'] > 0) {
    $label = "Edit";
}
if (isset($_GET['type']) && $_GET['type'] == 'delete' && isset($_GET['id']) && $_GET['id'] > 0) {
    $id = get_safe_value($_GET['id']);

    mysqli_query($con, "delete from expense where id=$id");
}
$res = mysqli_query($con, "select expense.*,category.name from expense,category where expense.category_id=category.id and expense.added_by='" . $_SESSION['UID'] . "'order by expense.expense_date asc ");
if (isset($_SESSION['UID']) && $_SESSION['UID'] != '') {
} else {
    redirect('index.php');
}
?>
<script>
    document.title="Dashboard";
 </script>
 <br><br><br><br>
<h2>Expense</h2>
<a href="manage_expense.php">Add Expense</a>
<br/>

<?php
if (mysqli_num_rows($res) > 0) {

?>
<script>
    document.title="Expense";
 </script>
    <div class="main-content">
        <div class="section__content section__content--p30">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                    
                    <!-- <h2>Expense</h2>
<a href="manage_expense.php" id="me">Add Expense</a> -->
<br><br>

                        <div class="table-responsive table--no-card m-b-30">
                            
                            <table class="table table-borderless table-striped table-earning">
                                <thead>

                                        <tr>
                                            <th>ID</th>
                                            <th>Category</th>
                                            <th>Item</th>
                                            <th>Price</th>
                                            <th>Details</th>
                                            <th>Expense Date</th>
                                            <th></th>
                                        </tr>
    <tbody>
    <?php
    while ($row = mysqli_fetch_assoc($res)) {
    ?>

        <tr>

            <td><?php echo $row['id'] ?></td>
            <td><?php echo $row['name'] ?></td>
            <td><?php echo $row['item'] ?></td>
            <td><?php echo $row['price'] ?></td>
            <td><?php echo $row['details'] ?></td>
            <td><?php echo $row['expense_date'] ?></td>
            <td>

                <a href="manage_expense.php?id=<?php echo $row['id']; ?>">Edit</a>&nbsp;
                <a href="javascript:void(0)" onclick="delete_confir('<?php echo $row['id']; ?>','expense.php')">Delete</a>
            </td>
        </tr>

    <?php

    } ?>
    </tbody>
</table>
<?php } else {
    ?><br><br><br><?php
    echo "Data Not found";
} ?>
</div>
                    </div>
                </div>
            </div>
        </div>
    </div>

<?php
include('footer.php');
?>
<style>
