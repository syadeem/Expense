<html>
<head>
    <title><?php echo $page_title ?></title>
    <script src="public/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="public/css/bootstrap.min.css" media="all" />

</head>
<body>

<div class="page-header">
    <h1>EXPENSE APPLICATION <small>Create & Check Your Expenses</small></h1>
</div>


<div class="container">
    <form method="post" action="create_expense">
        <div class="input-group ">
            <span class="input-group-addon">Description</span>
            <input type="text" class="form-control" name="desc" placeholder="expense details">
        </div>

        <br />

        <div class="input-group ">
            <span class="input-group-addon">$</span>
            <input type="text" class="form-control" name="amt" placeholder="expense amount">
            <span class="input-group-addon">.00</span>
        </div>

        <br />

        <button type="submit" class="btn btn-default btn-lg">Submit</button>


    </form>
</div>


<br /> <br />
<div class="panel panel-default">
    <!-- Default panel contents -->
    <div class="panel-heading">EXPENSE DETAILS</div>

    <!-- Table -->
    <table class="table">

           <thead>
       <tr>

           <th>S.NO</th><th>ID</th><th>DETAILS</th><th>AMOUNT</th><th>DATE CREATED</th><th>REMOVE</th></tr>
        </thead>
        <?php if (!empty ($expenses)): ?>
            <?php
            $j = 1;
            foreach($expenses as $expense): ?>

                <tr>
                    <td><?php echo $j; ?></td>
                    <td><?php echo $expense->id; ?></td>
                    <td><?php echo $expense->desc; ?></td>
                    <td><?php echo sprintf('$ %s',money_format('%i', $expense->amount)); ?></td>
                    <td><?php echo date('d/m/Y',$expense->created_on); ?></td>
                    <td>
                         <a href="/expense/delete/<?php echo $expense->id ?>"><button type="button" class="btn btn-danger btn-sm" />DELETE</button></a>
                    </td>

                </tr>
            <?php $j++; endforeach; ?>

                <?php endif; ?>
    </table>
</div>


</body>
</html>