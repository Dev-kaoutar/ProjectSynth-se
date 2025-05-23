 <style>
     .pagination {
         margin-top: 20px;
         text-align: center;
     }

     .pagination a {
         padding: 5px 10px;
         margin: 0 2px;
         border: 1px solid #ccc;
         color: #333;
         text-decoration: none;
     }

     .pagination a.active {
         background-color: #333;
         color: white;
         border-color: #333;
     }
 </style>
 <div class="pagination">
     <?php if ($page > 1): ?>
         <a href="?page=<?= $page - 1 ?>">&laquo; Précédent</a>
     <?php endif; ?>

     <?php for ($i = 1; $i <= $totalPages; $i++): ?>
         <a href="?page=<?= $i ?>" class="<?= ($i == $page) ? 'active' : '' ?>"><?= $i ?></a>
     <?php endfor; ?>

     <?php if ($page < $totalPages): ?>
         <a href="?page=<?= $page + 1 ?>">Suivant &raquo;</a>
     <?php endif; ?>
 </div>