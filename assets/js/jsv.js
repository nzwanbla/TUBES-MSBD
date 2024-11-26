function detailInfo(){ 
    document.getElementsByClassName("info-book-tab")[0].style.display="block"
   document.getElementsByClassName("catalog-list")[0].style.display="none"
    document.getElementsByClassName("detail-book-tab")[0].style.borderBottom= "2px solid red";
  document.getElementsByClassName("detail-book-tab")[0].style.color= "red";                   
  document.getElementsByClassName("catalog-book-tab")[0].style.borderBottom= "none";
  document.getElementsByClassName("catalog-book-tab")[0].style.color= "#666";                      
  document.getElementsByClassName("comment-book-tab")[0].style.borderBottom= "none";  document.getElementsByClassName("comment-book-tab")[0].style.color= "#666";                        
  };
  
  function detailCatalog(){ 
  document.getElementsByClassName("info-book-tab")[0].style.display="none"
   document.getElementsByClassName("catalog-list")[0].style.display="block"
    document.getElementsByClassName("detail-book-tab")[0].style.borderBottom= "none";
  document.getElementsByClassName("detail-book-tab")[0].style.color= "#666";                   
  document.getElementsByClassName("catalog-book-tab")[0].style.borderBottom= "2px solid red";
  document.getElementsByClassName("catalog-book-tab")[0].style.color= "red";                      
  document.getElementsByClassName("comment-book-tab")[0].style.borderBottom= "none";  document.getElementsByClassName("comment-book-tab")[0].style.color= "#666";                        
  };
  function detailComment(){ 
     document.getElementsByClassName("info-book-tab")[0].style.display="block"
   document.getElementsByClassName("catalog-list")[0].style.display="none"
    document.getElementsByClassName("detail-book-tab")[0].style.borderBottom= "none";
  document.getElementsByClassName("detail-book-tab")[0].style.color= "#666";                   
  document.getElementsByClassName("catalog-book-tab")[0].style.borderBottom= "none";
  document.getElementsByClassName("catalog-book-tab")[0].style.color= "#666";                      
  document.getElementsByClassName("comment-book-tab")[0].style.borderBottom= "2px solid red";  document.getElementsByClassName("comment-book-tab")[0].style.color= "red";                        
  };
  function commentSection(){
    document.getElementsByClassName("user-discuss")[0].style.display="block";
    document.getElementsByClassName("user-rating")[0].style.display="none";
  }
  function ratingSection(){
    document.getElementsByClassName("user-discuss")[0].style.display="none";
    document.getElementsByClassName("user-rating")[0].style.display="block";
  }
  function readmore(){
    document.getElementsByClassName("content-user-comment-partly")[0].style.display="none";
    document.getElementsByClassName("readmore-comment")[0].style.display="none";
    document.getElementsByClassName("content-user-comment-fully")[0].style.display="block";
  }