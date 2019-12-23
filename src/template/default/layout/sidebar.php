<div id="box-sidebar">
   <div class="sidebar category">
       <div class="sidebar-header">
           Kategorie
       </div>
       <div class="sidebar-content">
           <ul>
               <?php foreach ($this->data['categories'] as $category): ?>
               <li>
                   <a href="index.php?page=category&cid=<?= $category['id'] ?>"><?= $category['name'] ?><span><?= $category['entry_amount'] ?></span></a>

               </li>
               <?php endforeach; ?>
           </ul>
       </div>
   </div>
</div>