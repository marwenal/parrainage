function divCategorie(id){
    po=document.getElementById(id);
   onglets=document.getElementsByClassName("liCategorie");
   SousOnglets=document.getElementsByClassName("liSousCategorie");
   onglets[0].className="liCategorie selectedTab";
   for(i=0;i<onglets.length;i++)
   {
      SousOnglets[0];
   }
}
function select(id){
    po=document.getElementById(id);
     for(i=0;i<po.length;i++)
   {
       alert(po[i]);
   }
   
}
function donnesObligatoire()
    {
        if(form1.login.value == '')
                alert("Le champ  "+form1.login.name+ "   est obligatoire");
         else if(form1.email.value == '')
                alert("Le champ  "+form1.email.name+ "   est obligatoire");   
        else if(form1.password.value == '')
                alert("Le champ  "+form1.password.name+ "   est obligatoire"); 
        else if(form1.password1.value != form1.password.value)
                alert("Mots de passe non identiques");      
        return;
    }
    


