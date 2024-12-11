    $(document).ready(function(){
    $('#univ_year_select').on('change',function(){
    var yearid = $(this).val();

    });
    $('#univsector').on('change',function(){
    var univsectorid = $(this).val();
    alert(univsectorid);
    var yearid=$('#univ_year_select').val();
    alert(yearid);
    $.ajax({
    type:'POST',
    url:'backend.php',
    dataType: 'json',
    cache: false,
    data:{yearid:yearid , univsectorid:univsectorid},
    success: function(data){
    if(data!=""){
    alert(data[0]);
    for (var i=0;i<data[0].length;i++){ $('#univselect').append('<option value="'+data[0][i]+'">' +data[1][i]+ ' </option>');
        }
        }else{
        alert("no data to fetch")
        }
        }
        });
        });
        });





