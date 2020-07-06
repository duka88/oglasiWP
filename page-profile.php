<?php get_header(); ?>
<div class="profile-wrap">
    <h1>Dodaj oglas</h1>
    
    <form id="addAdForm" action="/">
       <div class="profile__input">
        <label for="name">Ime Predmeta</label>
        <input type="text" name="name">
       </div>
       <div class="profile__input">
        <label for="name">Cena</label>
        <input type="number" name="number" min="1">
       </div>
       <div class="profile__input">
        <label for="name">Stanje predmeta</label>
        <input type="radio" name="condition" value="new"><span>Novo</span>
        <input type="radio" name="condition" value="used"><span>Polovno</span>
       </div>
       <div class="profile__input">
        <label for="name">Lokacija</label>
        <input type="text" name="location">
       </div>
       <div class="profile__input">
        <label for="adPicture">
            <figure>
             
            <p>Slika</p>
            <img src="" alt="" class="d-none">
            <input id="adPicture" type="file" id="picture" name="picture" class="d-none">
          </figure>
        </label>
       </div>
       <div class="profile__input">
        <label for="name">Opis</label>
        <textarea name="description" id="" cols="30" rows="10"></textarea>
       </div>
       
    
       <div id="buttons" class="btn-wrap ">
            <div id="addAd"  class="btn">
               Prosledi
            </div>
           
        </div>
    </form>
   
 </div>
<?php get_footer(); ?>		