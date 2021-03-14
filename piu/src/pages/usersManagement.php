<?php 
    $role = "admin";
    $pageTitle = "Users Management | TasteBuds";
    $extraStyles = [ "adminArea.css", "../components/breadcrumb.css" ];

    include_once "../components/breadcrumb.php";
    include_once "../components/docHeader.php";
    include_once "../components/nav.php"; 

    function displayActions() { ?>
        <button type="button" class="btn btn-secondary me-2 my-2 has-tooltip" data-bs-toggle="tooltip" data-bs-placement="bottom" title="View user profile"><i class="fas fa-eye"></i></button>
        <button type="button" class="btn btn-warning text-white me-2 my-2 has-tooltip" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Ban user"><i class="fas fa-ban"></i></button>
        <button type="button" class="btn btn-danger has-tooltip my-2" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Delete user permanently"><i class="fas fa-trash"></i></button>
<?php } ?>
<?php drawBreadcrumb([ "Users Management" ]); ?>
<div class="content-general-margin mt-5 margin-to-footer">
    <h1 class="mb-4">Users Management</h1>
    <div class="d-flex admin-search-input">
        <input type="text" class="form-control icon-right mb-3" placeholder="Search" aria-label="User Search Query">
        <i class="fas fa-search fa-icon-right"></i>
    </div>
    <div class="card">
        <div class="card-body table-responsive">
        <table class="table align-middle table-striped table-hover">
            <thead>
                <th>Username</th>
                <th>Name</th>
                <th>E-Mail</th>
                <th>Country</th>
                <th>City</th>
                <th>N<sup>er</sup> of posts</th>
                <th>N<sup>er</sup> of comments</th>
                <th>N<sup>er</sup> of reports</th>
                <th>Actions</th>
            </thead>
            <tbody>   
                <tr>
                    <td>sarahxcolbert</td>
                    <td>Sarah Colbert</td>
                    <td>sarahxcolbert@mail.com</td>
                    <td>Italy</td>
                    <td>Milan</td>
                    <td>5</td>
                    <td>11</td>
                    <td>0</td>
                    <td><?=displayActions();?></td>
                </tr>   
                <tr>
                    <td>johnguy</td>
                    <td>John Guy</td>
                    <td>johnguy@mail.com</td>
                    <td>Italy</td>
                    <td>Venice</td>
                    <td>13</td>
                    <td>27</td>
                    <td>1</td>
                    <td><?=displayActions();?></td>
                </tr>   
            </tbody>
        </table>
        </div>
    </div>    
</div>

<?php 
    include_once "../components/footer.php";
    include_once "../components/docFooter.php";  
?>