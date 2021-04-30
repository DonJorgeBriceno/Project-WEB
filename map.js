function mapear(log, lat){
    const tilesProvider ='https://{s}.tile.openstreetmap.org/${z}/${x}/${y}.png';
    let myMap = L.map('mapid').setView([log, lat], 18);
    L.tileLayer(tilesProvider, {
       maxZoom: 18, 
    }).addTo(myMap);
    
    let marker = L.marker([log, lat]).addTo(myMap);
}