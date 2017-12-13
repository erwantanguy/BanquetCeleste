// JavaScript Document
(function() {
    tinymce.create('tinymce.plugins.mylink', {
        init : function(ed, url) {
            /*ed.addButton('englishversion', {
                title : 'English Version',
                image : url+'/../images/lang_en.png',
                onclick : function() {
                     ed.selection.setContent('<a class="fancybox" href="#">[lang_en]</a> <a class="fancybox" href="#">English Version</a>'/* + ed.selection.getContent() + '[/mylink]'*//*);
 
                }
            });*/
            ed.addButton('bouton', {
                title : 'Bouton',
                image : url+'/../images/bouton.png',
                onclick : function() {
                     ed.selection.setContent('[bouton link=""]' + ed.selection.getContent() + '[/bouton]');
 
                }
            });
            ed.addButton('lienF', {
                title : 'Lien formulaire',
                image : url+'/../images/lienF.png',
                onclick : function() {
                     ed.selection.setContent('[lienF link=""]' + ed.selection.getContent() + '[/lienF]');
 
                }
            });
            ed.addButton('formulaire', {
                title : 'Formulaire contact',
                image : url+'/../images/formulaire.png',
                onclick : function() {
                     ed.selection.setContent('[formulaire id=""]' + ed.selection.getContent() + '[/formulaire]');
 
                }
            });
        },
        createControl : function(n, cm) {
            return null;
        },
    });
    //tinymce.PluginManager.add('englishversion', tinymce.plugins.mylink);
    tinymce.PluginManager.add('bouton', tinymce.plugins.mylink);
    tinymce.PluginManager.add('lienF', tinymce.plugins.mylink);
    tinymce.PluginManager.add('formulaire', tinymce.plugins.mylink);
})();



