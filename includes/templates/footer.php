    <!-- Start the dashboard of admin page -->

    <footer style="bottom: 0">
        <div class="col-md-12">
            <p class="text-muted">Copyright &copy; Mohammad aLSLMAT
            </p>
        </div>
    </footer>
    <!-- bootstrap Scripts (assets/admin/Quill/quill.snow.css) -->
    <script src="assets/admin/jquery/dist/jquery.min.js"></script>
    <script src="assets/admin/popper.js/dist/umd/popper.min.js"></script>
    <script src="assets/admin/bootstrap/dist/js/bootstrap.min.js"></script>
    <script src="assets/admin/js/main.js"></script>
    <script src="assets/admin/chart.js/dist/Chart.bundle.min.js"></script>
    <script src="assets/admin/js/dashboard.js"></script>
    <script src="assets/admin/js/widgets.js"></script>
    <script src="assets/admin/jqvmap/dist/jquery.vmap.min.js"></script>
    <script src="assets/admin/jqvmap/examples/js/jquery.vmap.sampledata.js"></script>
    <script src="assets/admin/jqvmap/dist/maps/jquery.vmap.world.js"></script>

    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyARdVcREeBK44lIWnv5-iPijKqvlSAVwbw&callback=initMap"
        async></script>
    <script src="<?php echo $jss ;?>admin.js"></script>
    <script>
(function($) {
    "use strict";

    jQuery('#vmap').vectorMap({
        map: 'world_en',
        backgroundColor: null,
        color: '#ffffff',
        hoverOpacity: 0.7,
        selectedColor: '#1de9b6',
        enableZoom: true,
        showTooltip: true,
        values: sample_data,
        scaleColors: ['#1de9b6', '#03a9f5'],
        normalizeFunction: 'polynomial'
    });
})(jQuery);
    </script>


    <!-- Initialize Quill editor -->
    <script>
var toolbarOptions = [
    ['bold', 'italic', 'underline', 'strike'], // toggled buttons
    ['blockquote', 'code-block'],

    [{
        'header': 1
    }, {
        'header': 2
    }], // custom button values
    [{
        'list': 'ordered'
    }, {
        'list': 'bullet'
    }],
    [{
        'script': 'sub'
    }, {
        'script': 'super'
    }], // superscript/subscript
    [{
        'indent': '-1'
    }, {
        'indent': '+1'
    }], // outdent/indent
    [{
        'direction': 'rtl'
    }], // text direction

    [{
        'size': ['small', false, 'large', 'huge']
    }], // custom dropdown
    [{
        'header': [1, 2, 3, 4, 5, 6, false]
    }],

    [{
        'color': []
    }, {
        'background': []
    }], // dropdown with defaults from theme
    [{
        'font': []
    }],
    [{
        'align': []
    }],

    ['clean'] // remove formatting button
];
    </script>
    </body>

    </html>
