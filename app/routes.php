<?php

$w_routes = array(
    ['GET', '/', 'Default#home', 'default_home'],
    ['GET|POST', '/inscription/', 'Users#inscription', 'inscription_user'],
    
    ['GET|POST', '/list/', 'Users#list', 'list'],
    ['GET|POST', '/connexion/', 'Users#connexion', 'connexion'],
    ['GET', '/users/deconnexion', 'Users#logOut', 'user_logout'],
    
    ['GET|POST', '/blog/', 'Blog#blogAdd', 'blogAdd'],
    ['GET|POST', '/viewBlog/', 'Blog#listArticle', 'listArticle'],
    
    ['GET', '/chat/', 'Chat#chat', 'chat_view'],
    ['GET|POST', '/chat/ajax/add', 'Chat#addMessageAjax', 'chat_add'],
    ['GET|POST', '/chat/ajax/list', 'Chat#listMessagesAjax', 'chat_list'],
);

