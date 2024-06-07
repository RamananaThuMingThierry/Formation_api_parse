$(document).ready(function() {
  $('#dataTables').DataTable({
    dom: '<"row"<"col-sm-6"B><"col-sm-6">><"row"<"col-sm-6"l><"col-sm-6"f>>tip', // Utilisation d'une grille Bootstrap pour aligner les éléments sur la même ligne
    buttons: [
      {
        extend: 'copy',
        exportOptions: {
          columns: ':not(:last-child)'
        }
      },
      {
        extend: 'csv',
        exportOptions: {
          columns: ':not(:last-child)'
        }
      },
      {
        extend: 'excel',
        exportOptions: {
          columns: ':not(:last-child)'
        }
      },
      {
        extend: 'pdf',
        exportOptions: {
          columns: ':not(:last-child)'
        }
      },
      {
        extend: 'print',
        exportOptions: {
          columns: ':not(:last-child)'
        },
      }
    ],
    columnDefs: [
      { targets: -1, orderable: false }
    ],
    language: {
      "decimal": "",
      "emptyTable": "Aucune donnée disponible dans le tableau",
      "info": "Affichage de _START_ à _END_ sur _TOTAL_ entrées",
      "infoEmpty": "Affichage de 0 à 0 sur 0 entrées",
      "infoFiltered": "(filtré de _MAX_ entrées au total)",
      "infoPostFix": "",
      "thousands": ",",
      "lengthMenu": "Afficher _MENU_ entrées",
      "loadingRecords": "Chargement...",
      "processing": "Traitement...",
      "search": 'Recherche :', // Utiliser une grille Bootstrap pour envelopper uniquement le champ de recherche
      "zeroRecords": "Aucun enregistrement ne correspondant à votre recheche",
      "paginate": {
        "first": "Premier",
        "last": "Dernier",
        "next": "Suivant",
        "previous": "Précédent"
      },
      "aria": {
        "sortAscending": ": activer pour trier la colonne par ordre croissant",
        "sortDescending": ": activer pour trier la colonne par ordre décroissant"
      }
    }
  });
});
