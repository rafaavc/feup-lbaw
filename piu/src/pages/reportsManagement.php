<?php 
    $pageTitle = "Reports Management";
    $extraStyles = [ "adminArea.css", "../components/breadcrumb.css" ];
    include_once '../components/docHeader.php';
    include_once "../components/nav.php"; 
    include_once "../components/breadcrumb.php"; 

    function displayActions($comment=true) { ?>
        <button type="button" class="btn btn-secondary me-2 has-tooltip" data-bs-toggle="tooltip" data-bs-placement="bottom" title="View <?= $comment ? "comment" : "recipe" ?>"><i class="fas fa-eye"></i></button>
        <button type="button" class="btn btn-warning text-white me-2 has-tooltip" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Ban owner"><i class="fas fa-ban"></i></button>
        <button type="button" class="btn btn-danger has-tooltip me-2" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Delete the offensive <?= $comment ? "comment" : "recipe" ?>"><i class="fas fa-trash"></i></button>
        <button type="button" class="btn btn-secondary has-tooltip" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Dismiss report"><i class="fas fa-times"></i></button>
<?php } ?>
<?php drawBreadcrumb([ "Reports Management" ]); ?>
<div class="content-general-margin mt-5 margin-to-footer">
    <h1 class="mb-4">Reports Management</h1>
    <div class="d-flex admin-search-input">
        <input type="text" class="form-control icon-right mb-3" placeholder="Search" aria-label="Report Search Query">
        <i class="fas fa-search fa-icon-right"></i>
    </div>
    <div class="card">
        <div class="card-body">
        <table class="table align-middle table-striped table-hover">
            <thead>
                <th>Type</th>
                <th>Content</th>
                <th>Owner</th>
                <th>Reason for report</th>
                <th>Reported by</th>
                <th>Actions</th>
            </thead>
            <tbody>   
                <tr>
                    <td>Comment</td>
                    <td>Shut up you ape</td>
                    <td><a href="#">johnguy</a></td>
                    <td>Disrespectful</td>
                    <td><a href="#">annah_guttenberg</a></td>
                    <td><?=displayActions();?></td>
                </tr>   
                <!-- <tr>
                    <td>johnguy</td>
                    <td>John Guy</td>
                    <td>johnguy@mail.com</td>
                    <td>Italy</td>
                    <td>Venice</td>
                    <td>13</td>
                    <td>27</td>
                    <td>1</td>
                    <td><?=displayActions();?></td>
                </tr>    -->
            </tbody>
        </table>
        </div>
    </div>    
</div>

<?php 
    include_once "../components/footer.php";
    include_once "../components/docFooter.php";
?>