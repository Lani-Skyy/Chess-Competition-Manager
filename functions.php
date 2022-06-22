<?php
    function alert($message = NULL, $type = NULL) {
        if (isset($_SESSION["alert"])) {
            $message = $_SESSION["alert"]["message"];
            $type = $_SESSION["alert"]["type"];
            unset($_SESSION["alert"]);
        }

        if ($message and $type) {
            $alert = <<<HEREDOC
            <div class="alert alert-$type alert-dismissible fade show" role="alert">
            $message
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>
            HEREDOC;
            echo $alert;
        }
      }
?>