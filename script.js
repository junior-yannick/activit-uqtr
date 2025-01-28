function showSection(index) {
    // Obtenir toutes les sections suivant l'élément nav
    var sections = document.querySelectorAll('nav + section, nav + section ~ section');

   // Masquer toutes les sections
    sections.forEach(function(section) {
        section.style.display = 'none';
    });

   // Afficher la section ciblée
    sections[index].style.display = 'block';
}

// Validation du formulaire
function validateForm() {
    var nom = document.getElementById('nom').value;
    var prenom = document.getElementById('prenom').value;
    var dateNaissance = document.getElementById('date_naissance').value;
    var sexe = document.querySelector('input[name="sexe"]:checked');

    if (!nom || !prenom) {
        alert('Le nom et le prénom sont requis.');
        return false;
    }

    if (!dateNaissance) {
        alert('La date de naissance est requise.');
        return false;
    }

    if (!sexe) {
        alert('Le sexe doit être sélectionné.');
        return false;
    }

   
    return true;
}
function showDefaultMenu() {
    hideAllSections();
    // Afficher la première section (par défaut)
    document.querySelector('section:first-of-type').style.display = 'block';
}
function hideAllSections() {
    document.querySelectorAll('section').forEach(function(section) {
        section.style.display = 'none';
    });
}

function validate() {
    var identifiant = document.forms["authenticationForm"]["identifiant"].value;
    var password = document.forms["authenticationForm"]["password"].value;

    if (identifiant == "") {
        alert("Veuillez saisir un identifiant.");
        return false;
    }

    if (password == "") {
        alert("Veuillez saisir un mot de passe.");
        return false;
    }

   

    return true;
}


// Fonction pour initialiser la carte Google Maps
function initMap() {
    var mapDiv = document.getElementById('map'); 
    var map = new google.maps.Map(mapDiv, {
        center: {lat: 46.343239, lng: -72.543283}, 
        zoom:15
    });
}

// charger la boite de dialogue
document.addEventListener('DOMContentLoaded', function () {
    const modalOverlay = document.getElementById('modalOverlay');
    const modalContent = document.getElementById('modalContent');

    modalOverlay.addEventListener('click', function (event) {
        if (event.target === modalOverlay) {
            closeModal();
        }
    });
});

function openModal() {
    fetch('principale.php')
        .then(response => response.text())
        .then(data => {
            const modalContent = document.getElementById('modalContent');
            modalContent.innerHTML = data;

            const modalOverlay = document.getElementById('modalOverlay');
            modalOverlay.style.display = 'block';
        });
}

function closeModal() {
    const modalOverlay = document.getElementById('modalOverlay');
    modalOverlay.style.display = 'none';
}
function supprimerActivite(idActivite) {
    if(confirm('Êtes-vous sûr de vouloir supprimer cette activité ?')) {
        var xhr = new XMLHttpRequest();
        xhr.open('POST', 'supprimerActivite.php', true);
        xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
        xhr.onload = function () {
            if (this.status == 200) {
                alert('Activité supprimée avec succès');
                // Supprimer la ligne de la table
                document.querySelector('button[onclick="supprimerActivite('+idActivite+')"]').parentNode.parentNode.remove();
            } else {
                alert('Erreur lors de la suppression de l\'activité');
            }
        };
        xhr.send('id=' + idActivite);
    }
}


document.addEventListener("DOMContentLoaded", function () {
    // Sélectionnez toutes les balises canvas avec la classe pourcentageChart
    var canvasElements = document.querySelectorAll('.pourcentageChart');

    // Initialisez un graphique pour chaque élément canvas
    canvasElements.forEach(function (canvas) {
        var pourcentage = canvas.getAttribute('data-pourcentage');
        var ctx = canvas.getContext('2d');

       

        // Déterminez l'angle minimal à partir duquel l'arc jaune est affiché (en radians)
        var minAngleDisplayed = 0.01;

        var pourcentageChart = new Chart(ctx, {
            type: 'doughnut',
            data: {
                labels: [],
                datasets: [{
                    data: [pourcentage, 100 - pourcentage],
                    backgroundColor: ['#FFD700', '#fff'], 
                    borderWidth: pourcentage === '100' ? 0 : 25, 
                }],
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                cutout: '50%', 
                legend: {
                    display: false, // Masquer la légende
                },
                tooltips: {
                    enabled: false, // Désactiver les tooltips
                },
                elements: {
                    arc: {
                        borderWidth: 0 
                    }
                },
                // Ajouter le pourcentage à l'intérieur du cercle
                animation: {
                    animateRotate: false,
                    animateScale: false
                },
                events: [],
                onHover: function (event, elements) {
                    canvas.style.cursor = elements[0] ? 'pointer' : 'default';
                },
                plugins: {
                    legend: {
                        display: false,
                    },
                },
            },
            plugins: [{
                beforeDraw: function (chart) {
                    var width = chart.width,
                        height = chart.height,
                        ctx = chart.ctx;

                    // Ajouter le pourcentage à l'intérieur du cercle
                    var fontSize = Math.round(width / 13); 
                    ctx.font = 'bold ' + fontSize + 'px Arial'; 
                    ctx.fillStyle = '#000'; // Couleur du texte
                    ctx.textAlign = 'center';
                    ctx.textBaseline = 'middle';
                    ctx.fillText(pourcentage + '%', width / 2, height / 2);
                },
            }],
        });
    });
});


// permet d'afficher le mot de passe quand on clique sur l'oeil
document.querySelector('.toggle-password').addEventListener('click', function () {
    const passwordInput = document.querySelector(this.getAttribute('toggle'));
    this.classList.toggle('closed');
    passwordInput.type = passwordInput.type === 'password' ? 'text' : 'password';
});
