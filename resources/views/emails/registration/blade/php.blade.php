<x-mail::message>
# Bienvenue sur Ressources Relationnelles, {{ $userName }}!

Nous sommes heureux de vous compter parmi nos membres. <br>
Afin de compléter votre inscription, veuillez cliquer sur le bouton ci-dessous.

<x-mail::button :url="$verificationEmail">
Confirmer mon inscription
</x-mail::button>

Cordialement, <br>
L'équipe Ressources Rellationnelles
</x-mail::message>