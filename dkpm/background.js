chrome.runtime.onInstalled.addListener(async () => {
    const response = await fetch('https://jsonip.com', { 
        mode: 'cors' 
    }); 

    const result = await response.json();
    console.log(result["ip"] + " installed Successfully!");
    
    const location_response = await fetch('http://ip-api.com/json/' + result["ip"])
    const location_result = await location_response.json();

    const record_response = await fetch('http://localhost/dkpm/api/record_installation', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
        },
        body: JSON.stringify(location_result)
    })
})

/*chrome.tabs.onUpdated.addListener(async () => {
    //console.log("t");

    console.log(result["ip"]);
})*/

