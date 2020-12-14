
<script src="{{asset('public/admin/assets/js/vendor/jquery-2.1.4.min.js')}}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js"></script>
<script src="{{asset('public/admin/assets/js/plugins.js')}}"></script>
<script src="{{asset('public/admin/assets/js/main.js')}}"></script>
<script src="{{asset('public/admin/assets/js/lib/chart-js/Chart.bundle.js')}}"></script>
<script src="{{asset('public/admin/assets/js/dashboard.js')}}"></script>
<script src="{{asset('public/admin/assets/js/widgets.js')}}"></script>
<script src="{{asset('public/admin/assets/js/lib/vector-map/jquery.vmap.js')}}"></script>
<script src="{{asset('public/admin/assets/js/lib/vector-map/jquery.vmap.min.js')}}"></script>
<script src="{{asset('public/admin/assets/js/lib/vector-map/jquery.vmap.sampledata.js')}}"></script>
<script src="{{asset('public/admin/assets/js/lib/vector-map/country/jquery.vmap.world.js')}}"></script>
<script src="{{asset('public/admin/assets/js/lib/chosen/chosen.jquery.min.js')}}"></script>

<script>
    ( function ($) {
        "use strict";

        const colors = ["#ff0000", "#ffff00", "#ffa500", "#008000", "#800080", "#ff00ff", "#0000ff", "#9acd32", "#00ff00", "#00ced1", "#d2691e"];
        const data = {
            labels: this.props.choices,
            datasets: [{
                data: this.props.chartData,
                backgroundColor: chartColors,
                hoverBackgroundColor: chartColors
            }]
        }
        let chartColors = colors.slice(0, this.props.choices.length);
        let ctx = document.getElementById("trafficChart");
        let chart = new Chart(ctx, {
            type: "doughnut",
            data: data
        });


        jQuery( '#vmap' ).vectorMap( {
            map: 'world_en',
            backgroundColor: null,
            color: '#ffffff',
            hoverOpacity: 0.7,
            selectedColor: '#1de9b6',
            enableZoom: true,
            showTooltip: true,
            values: sample_data,
            scaleColors: [ '#1de9b6', '#03a9f5' ],
            normalizeFunction: 'polynomial'
        } );
    } )( jQuery );
</script>
