

function initMap() {

    // The location of Uluru
    const cebu = { lat: 10.678, lng: 123.776 };
    // Initialize some map with center at cebu
    const map = new google.maps.Map(document.getElementById('map'), {
        center: cebu,
        zoom: 8.7,
        mapTypeId: 'roadmap',
        disableDefaultUI: true,
        draggable: false, zoomControl: false, scrollwheel: false, disableDoubleClickZoom: true
    });

    const BantayanPolygons = bantayan_Delimeters.map(delimeter => {
        return new google.maps.Polygon({
        paths: delimeter,
        strokeColor: '#890A98',
        strokeOpacity: 0.8,
        strokeWeight: 3,
        fillColor: '#A708F5',
        fillOpacity: 0.35
        });
    });

    var CebuPolygon = new google.maps.Polygon({
        paths: cebu_Delimeters,
        strokeColor: '#890A98',
        strokeOpacity: 0.8,
        strokeWeight: 3,
        fillColor: '#A708F5',
        fillOpacity: 0.35
    });
    
    var Carcar_Polygon = new google.maps.Polygon({
        paths: carcar_Delimeters,
        strokeColor: '#890A98',
        strokeOpacity: 0.8,
        strokeWeight: 3,
        fillColor: '#A708F5',
        fillOpacity: 0.35
    });
   
    const Daanbantayan_Polygon = new google.maps.Polygon({
        paths: daanbantayan_Delimeters,
        strokeColor: '#890A98',
        strokeOpacity: 0.8,
        strokeWeight: 3,
        fillColor: '#A708F5',
        fillOpacity: 0.35
    });

    var Danao_Polygon = new google.maps.Polygon({
        paths: danao_Delimeters,
        strokeColor: '#890A98',
        strokeOpacity: 0.8,
        strokeWeight: 3,
        fillColor: '#A708F5',
        fillOpacity: 0.35
    });
    
    const LapulapuPolygons = lapulapu_Delimeters.map(delimeter => {
        return new google.maps.Polygon({
        paths: delimeter,
        strokeColor: '#890A98',
        strokeOpacity: 0.8,
        strokeWeight: 3,
        fillColor: '#A708F5',
        fillOpacity: 0.35
        });
    });
    
    var Liloan_Polygon = new google.maps.Polygon({
        paths: liloan_Delimeters,
        strokeColor: '#890A98',
        strokeOpacity: 0.8,
        strokeWeight: 3,
        fillColor: '#A708F5',
        fillOpacity: 0.35
    });

     var Mandaue_Polygon = new google.maps.Polygon({
        paths: mandaue_Delimeters,
        strokeColor: '#890A98',
        strokeOpacity: 0.8,
        strokeWeight: 3,
        fillColor: '#A708F5',
        fillOpacity: 0.35
    });
    
     var Minglanilla_Polygon = new google.maps.Polygon({
        paths: minglanilla_Delimeters,
        strokeColor: '#890A98',
        strokeOpacity: 0.8,
        strokeWeight: 3,
        fillColor: '#A708F5',
        fillOpacity: 0.35
    });
    
    var Naga_Polygon = new google.maps.Polygon({
        paths: naga_Delimeters,
        strokeColor: '#890A98',
        strokeOpacity: 0.8,
        strokeWeight: 3,
        fillColor: '#A708F5',
        fillOpacity: 0.35
    });
    
    var Talisay_Polygon = new google.maps.Polygon({
        paths: talisay_Delimeters,
        strokeColor: '#890A98',
        strokeOpacity: 0.8,
        strokeWeight: 3,
        fillColor: '#A708F5',
        fillOpacity: 0.35
    });
    
    var Toledo_Polygon = new google.maps.Polygon({
        paths: toledo_Delimeters,
        strokeColor: '#890A98',
        strokeOpacity: 0.8,
        strokeWeight: 3,
        fillColor: '#A708F5',
        fillOpacity: 0.35
    });


    const setBantayan =()=> {
        BantayanPolygons.forEach(poly=>{
            poly.setMap(map);
        });
    };

    const unsetBantayan =()=> {
        BantayanPolygons.forEach(poly=>{
            poly.setMap(null);
        });
    };

    const setCarcar =()=>{
        Carcar_Polygon.setMap(map);
    };

    const unsetCarcar =()=>{
        Carcar_Polygon.setMap(null);
    };

    const setCebu =()=>{
        CebuPolygon.setMap(map);
    };

    const unsetCebu =()=>{
        CebuPolygon.setMap(null);
    };

    const setDaanbantayan =()=>{
        Daanbantayan_Polygon.setMap(map);
    };

    const unsetDaanbantayan =()=>{
        Daanbantayan_Polygon.setMap(null);
    };

    const setDanao =()=>{
        Danao_Polygon.setMap(map);
    };

    const unsetDanao =()=>{
        Danao_Polygon.setMap(null);
    };

    const setLapuLapu =()=> {
        LapulapuPolygons.forEach(poly=>{
            poly.setMap(map);
        });
    };

    const unsetLapuLapu =()=> {
        LapulapuPolygons.forEach(poly=>{
            poly.setMap(null);
        });
    };

    const setLiloan =()=>{
        Liloan_Polygon.setMap(map);
    };

    const unsetLiloan =()=>{
        Liloan_Polygon.setMap(null);
    };

    const setMandaue =()=>{
        Mandaue_Polygon.setMap(map);
    };

    const unsetMandaue =()=>{
        Mandaue_Polygon.setMap(null);
    };

    const setMinglanilla =()=>{
        Minglanilla_Polygon.setMap(map);
    };

    const unsetMinglanilla =()=>{
        Minglanilla_Polygon.setMap(null);
    };

    const setNaga =()=>{
        Naga_Polygon.setMap(map);
    };

    const unsetNaga =()=>{
        Naga_Polygon.setMap(null);
    };

    const setTalisay =()=>{
        Talisay_Polygon.setMap(map);
    };

    const unsetTalisay =()=>{
        Talisay_Polygon.setMap(null);
    };

    const setToledo =()=>{
        Toledo_Polygon.setMap(map);
    };

    const unsetToledo =()=>{
        Toledo_Polygon.setMap(null);
    };

    const setPolygons = [
        setBantayan, setCarcar, setCebu, setDaanbantayan, setDanao, setLapuLapu, setLiloan, setMandaue, setMinglanilla, setNaga, setTalisay, setToledo
    ];

    const unsetPolygons = [
        unsetBantayan, unsetCarcar, unsetCebu, unsetDaanbantayan, unsetDanao, unsetLapuLapu, unsetLiloan, unsetMandaue, unsetMinglanilla, unsetNaga, unsetTalisay, unsetToledo
    ];

    const cityNames = ["Bantayan", "Carcar", "Cebu City", "Daanbantayan", "Danao", "Lapu-lapu", "Liloan", "Mandaue", "Minglanilla", "Naga", "Talisay", "Toledo"];
    // const cityIds = ["1", "2", "3", "4", "5", "6", "7", "8", "9", "10", "11", "12"];
    // for(let x = 0; x < cityNames.length; x++){
    //     const check = document.getElementById("chk-"+cityNames[x]);
    //     // const check = document.getElementById("chk-"+cityIds[x]);
    //     check.addEventListener("click", ()=>{
    //         if(check.checked){
    //             setPolygons[x]();
    //         } else {
    //             unsetPolygons[x]();
    //         }
    //     });

    //     // Load checked images
    //     if(check.checked){
    //         console.log(cityNames[x]+" is checked!");
    //     }


    // }

    $(document).ready(()=>{
        for(let x = 0; x < cityNames.length; x++){
            const check = document.getElementById("chk-"+cityNames[x]);
            // const check = document.getElementById("chk-"+cityIds[x]);
            check.addEventListener("click", ()=>{
                if(check.checked){
                    setPolygons[x]();
                } else {
                    unsetPolygons[x]();
                }
            });
    
            // Load checked polygons
            if(check.checked){
                setPolygons[x]();
            }
        }
    });

};
