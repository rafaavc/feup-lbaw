<?php 
    $role = "member";
    $pageTitle = "Private Messages | TasteBuds";
    $extraStyles = [ "../components/navPopups.css", "privateMessages.css", "../components/breadcrumb.css" ];
    include_once "../components/conversationCard.php";
    include_once "../components/messageLine.php"; 
    include_once "../components/breadcrumb.php"; 


    include_once "../components/docHeader.php"; 
    include_once "../components/nav.php"; 
?>
<?php drawBreadcrumb([ "Private Messages" ]); ?>
<div id="messagesMobile" class="mt-2">
    <button type="button" class="btn btn-outline-secondary" data-bs-toggle="collapse" data-bs-target="#conversationsCollapse" aria-expanded="false" aria-controls="conversationsCollapse">
        <i class="fas fa-comments me-2"></i> Conversations
    </button>
    <button type="button" class="btn btn-primary square-button float-end">
        <i class="fas fa-pencil-alt"></i>
    </button>
    <div class="collapse" id="conversationsCollapse">
        <div class="card card-body p-0">
            <div active class="p-3 conversation-card m-0" active>
                <?= displayConversationCard("Sarah Colbert", "Sarah: That's nice!", "https://external-content.duckduckgo.com/iu/?u=https%3A%2F%2Fimages.pexels.com%2Fphotos%2F372042%2Fpexels-photo-372042.jpeg%3Fcs%3Dsrgb%26dl%3Dfashion-person-people-372042.jpg%26fm%3Djpg&f=1&nofb=1", true); ?>
            </div>
            <hr class="dropdown-divider m-0">
            <div class="p-3 conversation-card m-0">
                <?= displayConversationCard("John Guy", "You: Okay bro.", "https://external-content.duckduckgo.com/iu/?u=https%3A%2F%2Fmedia.istockphoto.com%2Fphotos%2Fyoung-man-picture-id155602235%3Fk%3D6%26m%3D155602235%26s%3D612x612%26w%3D0%26h%3DpWOQoAJ5p8xzfTWuHMfwj6jCgwH393t2jVbdDeoLKwM%3D&f=1&nofb=1"); ?>
            </div>
            <hr class="dropdown-divider m-0">
            <div class="p-3 conversation-card m-0">
                <?= displayConversationCard("Alexa Nixon", "Alexa: That sounds delicious!", "https://external-content.duckduckgo.com/iu/?u=https%3A%2F%2Fimage.freepik.com%2Ffree-photo%2Fthoughtful-girl-cooking-with-cookbook_1398-3595.jpg&f=1&nofb=1", false); ?>
            </div>
        </div>
    </div>

</div>
<div class="card content-general-margin margin-to-footer mt-2" id="privateMessages">
    <div class="row g-0">
        <div class="col col-lg-4 p-3 disappear">
            <h5 class="m-0 d-inline-block mt-1">Conversations</h5>
            <button type="button" class="btn btn-primary square-button float-end">
                <i class="fas fa-pencil-alt"></i>
            </button>
        </div>
        <div class="col p-3">
            <strong class="d-inline-block mt-1">Sarah Colbert</strong>
            <button type="button" class="btn btn-outline-secondary float-end py-1">
                <small><i class="fas fa-user me-2"></i>
                View Profile</small>
            </button>
        </div>
    </div>
    <div class="row g-0">
        <div class="col col-lg-4 disappear">
            <div class="container p-3 conversation-card" active>
                <?= displayConversationCard("Sarah Colbert", "Sarah: That's nice!", "https://external-content.duckduckgo.com/iu/?u=https%3A%2F%2Fimages.pexels.com%2Fphotos%2F372042%2Fpexels-photo-372042.jpeg%3Fcs%3Dsrgb%26dl%3Dfashion-person-people-372042.jpg%26fm%3Djpg&f=1&nofb=1", true); ?>
            </div>
            <hr class="dropdown-divider m-0">
            <div class="container p-3 conversation-card">
                <?= displayConversationCard("John Guy", "You: Okay bro.", "https://external-content.duckduckgo.com/iu/?u=https%3A%2F%2Fmedia.istockphoto.com%2Fphotos%2Fyoung-man-picture-id155602235%3Fk%3D6%26m%3D155602235%26s%3D612x612%26w%3D0%26h%3DpWOQoAJ5p8xzfTWuHMfwj6jCgwH393t2jVbdDeoLKwM%3D&f=1&nofb=1"); ?>
            </div>
            <hr class="dropdown-divider m-0">
            <div class="container p-3 conversation-card">
                <?= displayConversationCard("Alexa Nixon", "Alexa: That sounds delicious!", "https://external-content.duckduckgo.com/iu/?u=https%3A%2F%2Fimage.freepik.com%2Ffree-photo%2Fthoughtful-girl-cooking-with-cookbook_1398-3595.jpg&f=1&nofb=1", false); ?>
            </div>
            <hr class="dropdown-divider m-0">
        </div>
        <div class="col p-3 position-relative conversation-area">
            <div class="row-6 g-0 message-container position-relative">
                <div class="date-time-display">
                    <small>19 Feb 2021, 16:19</small>
                </div>
                <?= displayMessageLine("Hey", 9.6, "https://external-content.duckduckgo.com/iu/?u=https%3A%2F%2Fimages.pexels.com%2Fphotos%2F372042%2Fpexels-photo-372042.jpeg%3Fcs%3Dsrgb%26dl%3Dfashion-person-people-372042.jpg%26fm%3Djpg&f=1&nofb=1"); ?>
                <?= displayMessageLine("Hello :)", 9.5); ?>
                <?= displayMessageLine("Can you send me the recipe for the tasty mousse that you talk about in the last one you published?", 4.2, "https://external-content.duckduckgo.com/iu/?u=https%3A%2F%2Fimages.pexels.com%2Fphotos%2F372042%2Fpexels-photo-372042.jpeg%3Fcs%3Dsrgb%26dl%3Dfashion-person-people-372042.jpg%26fm%3Djpg&f=1&nofb=1"); ?>
                <?= displayMessageLine("Of course! I will publish it once I get home.", 3.5); ?>
                <?= displayMessageLine("That's nice!", 0, "https://external-content.duckduckgo.com/iu/?u=https%3A%2F%2Fimages.pexels.com%2Fphotos%2F372042%2Fpexels-photo-372042.jpeg%3Fcs%3Dsrgb%26dl%3Dfashion-person-people-372042.jpg%26fm%3Djpg&f=1&nofb=1"); ?>
            </div>
            <div class="form-floating" id="messageTextarea">
                <textarea class="form-control" placeholder="Write your message..." id="floatingTextarea2"></textarea>
                <label for="floatingTextarea2">Message</label>
                <button type="button" class="btn btn-primary position-absolute py-1 send">
                    <small><i class="fas fa-paper-plane me-2"></i>
                    Send</small>
                </button>
            </div>
        </div>
    </div>
</div>
<?php 
    include_once "../components/footer.php"; 
    include_once "../components/docFooter.php";
?>   
