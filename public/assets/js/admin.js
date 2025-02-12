document.addEventListener('DOMContentLoaded', function() {
    const menuLinks = document.querySelectorAll('nav a');
    const contentArea = document.getElementById('content-area');
    const pageTitle = document.getElementById('page-title');
    const pageActionButton = document.getElementById('page-action-button');
    const statsContainer = document.getElementById('stats-container'); // Récupérer le conteneur des statistiques

    // Simulation des données (à remplacer par des appels API réels)
    let events = [
        { id: 1, title: 'Conférence Tech', date: '2024-03-15', status: 'approved', organizer: 'Alice Dupont' },
        { id: 2, title: 'Festival Musique', date: '2024-04-20', status: 'pending', organizer: 'Bob Martin' },
        { id: 3, title: 'Atelier Cuisine', date: '2024-05-10', status: 'approved', organizer: 'Charlie Durand' }
    ];

    let users = [
        { id: 1, name: 'Alice Dupont', email: 'alice.dupont@example.com', role: 'admin', status: 'active', registrationDate: '2023-01-15' },
        { id: 2, name: 'Bob Martin', email: 'bob.martin@example.com', role: 'organizer', status: 'active', registrationDate: '2023-02-20' },
        { id: 3, name: 'Charlie Durand', email: 'charlie.durand@example.com', role: 'user', status: 'banned', registrationDate: '2023-03-10' }
    ];

     let organizerRequests = [
        { id: 4, name: 'David Leblanc', email: 'david.leblanc@example.com', details: 'Souhaite organiser des événements sportifs' },
        { id: 5, name: 'Eve Roy', email: 'eve.roy@example.com', details: 'Passionnée par les événements culturels' }
    ];

    // Fonction utilitaire pour afficher un message de confirmation
    function showConfirmation(message, callback) {
        if (confirm(message)) {
            callback();
        }
    }

    // Fonction pour mettre à jour l'affichage
    function updateDisplay() {
        const currentPage = location.hash.substring(1) || 'dashboard';
        loadContent(currentPage);
    }

     // Fonction pour charger les statistiques
     async function loadStats() {
            try {
                // Simule une requête API (à remplacer par votre propre appel API)
                const stats = {
                    totalEvents: Math.floor(Math.random() * 300),
                    totalUsers: Math.floor(Math.random() * 1500),
                    upcomingEvents: Math.floor(Math.random() * 50)
                };

                // Afficher les statistiques dans le conteneur
                statsContainer.innerHTML = `
                    <div class="bg-white shadow-md rounded-md p-4">
                        <h3 class="text-lg font-semibold text-gray-700">Événements Totaux</h3>
                        <p class="text-3xl font-bold text-blue-500" id="total-events">${stats.totalEvents}</p>
                    </div>
                    <div class="bg-white shadow-md rounded-md p-4">
                        <h3 class="text-lg font-semibold text-gray-700">Utilisateurs Inscrits</h3>
                        <p class="text-3xl font-bold text-green-500" id="total-users">${stats.totalUsers}</p>
                    </div>
                    <div class="bg-white shadow-md rounded-md p-4">
                        <h3 class="text-lg font-semibold text-gray-700">Événements à Venir</h3>
                        <p class="text-3xl font-bold text-orange-500" id="upcoming-events">${stats.upcomingEvents}</p>
                    </div>

                    <div class="bg-white shadow-md rounded-md p-4 col-span-1 md:col-span-3">
                        <h3 class="text-lg font-semibold text-gray-700">Inscriptions par Mois</h3>
                        <canvas id="monthly-registrations-chart"></canvas>
                    </div>
                `;

                // Données simulées pour le graphique (à remplacer par des données réelles)
                const monthlyRegistrations = [65, 59, 80, 81, 56, 55, 40,70,45,78,92,52];
                const labels = ['Jan', 'Fév', 'Mar', 'Avr', 'Mai', 'Juin', 'Juil','Aou','Sep','Oct','Nov','Dec'];

                // Création du graphique
                const ctx = document.getElementById('monthly-registrations-chart').getContext('2d');
                const myChart = new Chart(ctx, {
                    type: 'bar',
                    data: {
                        labels: labels,
                        datasets: [{
                            label: 'Inscriptions',
                            data: monthlyRegistrations,
                            backgroundColor: 'rgba(54, 162, 235, 0.2)',
                            borderColor: 'rgba(54, 162, 235, 1)',
                            borderWidth: 1
                        }]
                    },
                    options: {
                        scales: {
                            y: {
                                beginAtZero: true
                            }
                        }
                    }
                });

            } catch (error) {
                console.error('Erreur lors du chargement des statistiques:', error);
                contentArea.innerHTML = '<p class="text-red-500">Erreur lors du chargement des statistiques.</p>';
            }
        }
    // Fonction pour charger le contenu de la page
    function loadContent(page) {
        statsContainer.style.display = 'none'; // Cacher par défaut

        switch (page) {
            case 'evenements':
                pageTitle.textContent = 'Gestion des Événements';
                pageActionButton.textContent = 'Ajouter un Événement';
                pageActionButton.classList.remove('hidden');
                loadEvents();
                break;
            case 'utilisateurs':
                pageTitle.textContent = 'Gestion des Utilisateurs';
                pageActionButton.classList.add('hidden'); // Pas de bouton d'action sur cette page
                loadUsers();
                break;
            case 'organisateurs':
                pageTitle.textContent = 'Approbation des Organisateurs';
                pageActionButton.classList.add('hidden');
                loadOrganizerRequests();
                break;
            case 'dashboard':
                pageTitle.textContent = 'Dashboard';
                pageActionButton.classList.add('hidden');
                statsContainer.style.display = 'grid';
                loadDashboard();
                break;
            case 'parametres':
                pageTitle.textContent = 'Paramètres';
                pageActionButton.classList.add('hidden');
                contentArea.innerHTML = '<h1>Paramètres</h1><p>Ici, vous pouvez configurer les paramètres du site.</p>';
                break;
            default:
                pageTitle.textContent = 'Dashboard';
                pageActionButton.classList.add('hidden');
                statsContainer.style.display = 'grid';
                loadDashboard();
                break;
        }
    }

    // DASHBOARD
    function loadDashboard() {
        loadStats();
        contentArea.innerHTML = '<p>Bienvenue sur le tableau de bord d\'administration !</p>';
    }

    // EVENEMENTS
    function loadEvents() {
        let html = '<h1>Gestion des Événements</h1>';
        html += '<table class="table-auto w-full">';
        html += '<thead><tr><th class="px-4 py-2">Titre</th><th class="px-4 py-2">Date</th><th class="px-4 py-2">Organisateur</th><th class="px-4 py-2">Statut</th><th class="px-4 py-2">Actions</th></tr></thead>';
        html += '<tbody>';
        events.forEach(event => {
            html += `<tr>
                       <td class="border px-4 py-2">${event.title}</td>
                       <td class="border px-4 py-2">${event.date}</td>
                       <td class="border px-4 py-2">${event.organizer}</td>
                       <td class="border px-4 py-2">${event.status}</td>
                       <td class="border px-4 py-2">
                           <button class="bg-green-500 hover:bg-green-700 text-white font-bold py-1 px-2 rounded mr-2" onclick="approveEvent(${event.id})">Approuver</button>
                           <button class="bg-red-500 hover:bg-red-700 text-white font-bold py-1 px-2 rounded" onclick="deleteEvent(${event.id})">Supprimer</button>
                       </td>
                     </tr>`;
        });
        html += '</tbody></table>';
        contentArea.innerHTML = html;
    }

    // UTILISATEURS
    function loadUsers() {
        let html = '<h1>Gestion des Utilisateurs</h1>';
        html += '<table class="table-auto w-full">';
        html += '<thead><tr><th class="px-4 py-2">Nom</th><th class="px-4 py-2">Email</th><th class="px-4 py-2">Rôle</th><th class="px-4 py-2">Statut</th><th class="px-4 py-2">Actions</th></tr></thead>';
        html += '<tbody>';
        users.forEach(user => {
            html += `<tr>
                       <td class="border px-4 py-2">${user.name}</td>
                       <td class="border px-4 py-2">${user.email}</td>
                       <td class="border px-4 py-2">
                           <select class="role-select bg-gray-50 border border-gray-300 rounded py-1 px-2" data-user-id="${user.id}" onchange="changeUserRole(this, ${user.id})">
                               <option value="user" ${user.role === 'user' ? 'selected' : ''}>Utilisateur</option>
                               <option value="organizer" ${user.role === 'organizer' ? 'selected' : ''}>Organisateur</option>
                               <option value="admin" ${user.role === 'admin' ? 'selected' : ''}>Administrateur</option>
                           </select>
                       </td>
                       <td class="border px-4 py-2">${user.status}</td>
                       <td class="border px-4 py-2">
                           <button class="bg-yellow-500 hover:bg-yellow-700 text-white font-bold py-1 px-2 rounded mr-2" onclick="toggleBanUser(${user.id})">${user.status === 'active' ? 'Bannir' : 'Débannir'}</button>
                           <button class="bg-red-500 hover:bg-red-700 text-white font-bold py-1 px-2 rounded" onclick="deleteUser(${user.id})">Supprimer</button>
                       </td>
                     </tr>`;
        });
        html += '</tbody></table>';
        contentArea.innerHTML = html;
    }

    // ORGANISATEURS (à approuver)
    function loadOrganizerRequests() {
        let html = '<h1>Demandes d\'inscription d\'organisateurs</h1>';
        html += '<table class="table-auto w-full">';
        html += '<thead><tr><th class="px-4 py-2">Nom</th><th class="px-4 py-2">Email</th><th class="px-4 py-2">Détails</th><th class="px-4 py-2">Actions</th></tr></thead>';
        html += '<tbody>';
        organizerRequests.forEach(request => {
            html += `<tr>
                       <td class="border px-4 py-2">${request.name}</td>
                       <td class="border px-4 py-2">${request.email}</td>
                       <td class="border px-4 py-2">${request.details}</td>
                       <td class="border px-4 py-2">
                           <button class="bg-green-500 hover:bg-green-700 text-white font-bold py-1 px-2 rounded mr-2" onclick="approveOrganizer(${request.id})">Approuver</button>
                           <button class="bg-red-500 hover:bg-red-700 text-white font-bold py-1 px-2 rounded" onclick="rejectOrganizer(${request.id})">Rejeter</button>
                       </td>
                     </tr>`;
        });
        html += '</tbody></table>';
        contentArea.innerHTML = html;
    }

    // --- FONCTIONS DE GESTION (SIMULÉES) ---
    window.approveEvent = function(eventId) {
        showConfirmation(`Êtes-vous sûr d'approuver cet événement (ID: ${eventId}) ?`, () => {
            const event = events.find(e => e.id === eventId);
            if (event) {
                event.status = 'approved';
                updateDisplay();
            }
        });
    };

    window.deleteEvent = function(eventId) {
        showConfirmation(`Êtes-vous sûr de supprimer cet événement (ID: ${eventId}) ?`, () => {
            events = events.filter(e => e.id !== eventId);
            updateDisplay();
        });
    };

    window.toggleBanUser = function(userId) {
        const user = users.find(u => u.id === userId);
        if (user) {
            user.status = user.status === 'active' ? 'banned' : 'active';
            updateDisplay();
        }
    };

    window.deleteUser = function(userId) {
        showConfirmation(`Êtes-vous sûr de supprimer cet utilisateur (ID: ${userId}) ?`, () => {
            users = users.filter(u => u.id !== userId);
            updateDisplay();
        });
    };
    window.changeUserRole = function(selectElement, userId) {
        const newRole = selectElement.value;
        const user = users.find(u => u.id === userId);
        if (user) {
            user.role = newRole;
            console.log(`Role de l'utilisateur ${userId} modifié à : ${newRole}`);
            // Ici, vous devriez également envoyer cette modification à votre backend
        }
    };

    window.approveOrganizer = function(organizerId) {
        showConfirmation(`Êtes-vous sûr d'approuver cet organisateur (ID: ${organizerId}) ?`, () => {
            const organizer = organizerRequests.find(o => o.id === organizerId);
            if (organizer) {
                 // Créer un nouvel utilisateur avec le rôle "organisateur"
                 users.push({
                     id: organizer.id,
                     name: organizer.name,
                     email: organizer.email,
                     role: 'organizer',
                     status: 'active',
                     registrationDate: new Date().toLocaleDateString()
                 });

                // Supprimer la demande de la liste
                organizerRequests = organizerRequests.filter(o => o.id !== organizerId);
                updateDisplay();
            }
        });
    };

    window.rejectOrganizer = function(organizerId) {
        showConfirmation(`Êtes-vous sûr de rejeter cet organisateur (ID: ${organizerId}) ?`, () => {
            organizerRequests = organizerRequests.filter(o => o.id !== organizerId);
            updateDisplay();
        });
    };

    // Écouteur d'événements pour la navigation
    window.addEventListener('hashchange', updateDisplay);

    // Initialisation
    updateDisplay();
});