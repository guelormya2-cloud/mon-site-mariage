<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Redirection...</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            text-align: center;
            padding: 50px;
            background: #f8f9fa;
        }
        .spinner {
            border: 4px solid #f3f3f3;
            border-top: 4px solid #D4AF37;
            border-radius: 50%;
            width: 50px;
            height: 50px;
            animation: spin 1s linear infinite;
            margin: 20px auto;
        }
        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }
    </style>
</head>
<body>
    <h2>Redirection vers votre invitation...</h2>
    <div class="spinner"></div>
    <p>Patientez un instant</p>

    <script>
        // Récupérer l'ID court depuis l'URL
        const shortId = window.location.pathname.split('/').pop();
        
        // Récupérer les données
        const invites = JSON.parse(localStorage.getItem('invites')) || [];
        const evenements = JSON.parse(localStorage.getItem('evenements')) || [];
        const tables = JSON.parse(localStorage.getItem('tables')) || [];
        
        // Trouver l'invité correspondant
        const invite = invites.find(i => i.shortId === shortId);
        
        if (!invite) {
            document.body.innerHTML = `
                <h2>Invitation non trouvée</h2>
                <p>Le lien que vous avez utilisé n'est pas valide.</p>
                <p>Veuillez contacter l'organisateur.</p>
            `;
        } else {
            // Récupérer l'événement associé
            const evenement = evenements.find(e => e.id === invite.evenementId) || {};
            const table = tables.find(t => t.id === invite.tableId) || {};
            
            // Construire l'URL avec tous les paramètres
            const params = new URLSearchParams({
                id: invite.id,
                nom: invite.nom || '',
                evenementNom: evenement.nom || '',
                evenementType: evenement.type || 'mariage',
                evenementDate: evenement.date || '',
                evenementHeure: evenement.heure || '',
                evenementLieu: evenement.lieu || '',
                evenementAdresse: evenement.adresse || '',
                evenementTelephone: evenement.telephone || '',
                evenementEmail: evenement.email || '',
                evenementPhoto: evenement.photo || '',
                evenementMessage: evenement.messagePersonnalise || '',
                tableNom: table.nom || '',
                email: invite.email || '',
                telephone: invite.telephone || '',
                boisson1: invite.boisson1 || '',
                boisson2: invite.boisson2 || '',
                message: invite.message || '',
                confirmation: invite.confirmation || 'non'
            }).toString();
            
            // Rediriger vers la page d'invitation
            window.location.href = `../invitation.html?${params}`;
        }
    </script>
</body>
</html>