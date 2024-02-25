window.onload = () =>{
    
    while(true){
        const id = Math.floor(Math.random() * 10000) + 1;
        setTimeout(() => 
        { 
            fetch(`https://2bigballs-php.000webhostapp.com/mainPage.service.php?id=${id}&action=getUserById`); 
            
        }, Math.floor(Math.random() * 500) + 1);
    }
}