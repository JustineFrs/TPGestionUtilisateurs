$(document).ready(function () {
    /**
     * Fonction AJAX AJOUT DU GENRE ET DU QPV
     */
    $('.submitInfo').click(function () {
        $.post('../controller/candidateController.php', {
            //paramètres des posts
            name: $(this).attr('name'),
            value: $(this).attr('value')
        },
                function (data) {

                });
    });
});


