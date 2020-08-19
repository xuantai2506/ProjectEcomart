$(document).ready(function(){
    $('#print-chart-btn').on('click', function() {

        var canvas = document.querySelector("#myChart");

        var canvas_img = canvas.toDataURL("image/png",1.0); //JPEG will not match background color

        var pdf = new jsPDF('landscape','in', 'letter'); //orientation, units, page size

        pdf.addImage(canvas_img, 'png', .5, 1.75, 10, 5); //image, type, padding left, padding top, width, height

        pdf.autoPrint(); //print window automatically opened with pdf

        var blob = pdf.output("bloburl");
        
        window.open(blob);
    });
})

function ajaxGetPostMonthlyData(){
    
    let month = $('#month').val();

    $.ajaxSetup({

        headers: {
           'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        } 

    });

    $.ajax({

        type:"POST",

        url :'/admin/get_post_chartjs_data/admin',

        data : 
        {
            month : month,
        },

        success:function(response){

            showChart( response );

        }
    })
    

}

function showChart( response ) {

    data = response[1];

    labels =  response[0];

    renderChart(data, labels);

}

function renderChart(data, labels) {

    var ctx = document.getElementById("myChart").getContext('2d');

    var myChart = new Chart(ctx, {

        type: 'line',

        data: {
            labels: labels,
            datasets: [{
                label: 'Lượt truy cập',
                data: data,
            }]
        },

    });
}

ajaxGetPostMonthlyData();
showChart();