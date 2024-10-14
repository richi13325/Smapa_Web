document.addEventListener("DOMContentLoaded", function () {
    // Objeto para almacenar las cantidades de cada material
    const materiales = {
        tubo_pvc: 0,
        polietileno: 0,
        asbesto: 0,
        fierro: 0,
        cople: 0,
        cople_pvc: 0,
        cople_kitec: 0,
        cople_cobre: 0,
        llave_cobrer: 0,
        llave_kitec: 0
    };

    // Función para actualizar el valor en pantalla y en el objeto
    function updateQuantity(buttonId, increment) {
        const button = document.getElementById(buttonId);
        const numElement = button.querySelector(".num");
        let currentValue = parseInt(numElement.textContent);
        
        // Aumentar o disminuir el valor
        currentValue = increment ? currentValue + 1 : currentValue - 1;
        currentValue = currentValue < 0 ? 0 : currentValue;  // No permitir valores negativos

        // Actualizar el valor en el HTML y en el objeto
        numElement.textContent = currentValue;
        materiales[buttonId] = currentValue;
    }

    // Añadir eventos a todos los botones
    document.querySelectorAll(".cant_button").forEach(button => {
        const buttonId = button.id;
        button.querySelector(".mas").addEventListener("click", function () {
            updateQuantity(buttonId, true);
        });
        button.querySelector(".menos").addEventListener("click", function () {
            updateQuantity(buttonId, false);
        });
    });

    // Evento para enviar los datos a PHP
    document.getElementById("submit_button").addEventListener("click", function () {
        // Convertir los datos del objeto a JSON
        const data = JSON.stringify(materiales);
        
        // Enviar los datos con una petición fetch
        fetch("guardar_materiales.php", {
            method: "POST",
            headers: {
                "Content-Type": "application/json"
            },
            body: data
        })
        .then(response => response.text())
        .then(result => {
            console.log(result);  // Ver respuesta de PHP
        })
        .catch(error => {
            console.error("Error:", error);
        });
    });
});
