document.addEventListener("DOMContentLoaded", function () {

    /*
    |--------------------------------------------------------------------------
    | Close mobile navbar after clicking menu item
    |--------------------------------------------------------------------------
    */

    const navLinks =
        document.querySelectorAll(".navbar-nav .nav-link");

    navLinks.forEach(function (link) {

        link.addEventListener("click", function () {

            const navbar =
                document.querySelector(".navbar-collapse");

            if (
                navbar &&
                navbar.classList.contains("show")
            ) {

                const bsCollapse =
                    bootstrap.Collapse.getInstance(navbar);

                if (bsCollapse) {

                    bsCollapse.hide();

                }

            }

        });

    });


    /*
    |--------------------------------------------------------------------------
    | Minimum appointment date = today
    |--------------------------------------------------------------------------
    */

    const appointmentDate =
        document.querySelector(
            'input[name="appointment_date"]'
        );

    if (appointmentDate) {

        const today =
            new Date().toISOString().split("T")[0];

        appointmentDate.min = today;

    }

});