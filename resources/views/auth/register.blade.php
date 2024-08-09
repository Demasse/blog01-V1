<x-auth-layout title="inscription" :action="route('register')" submitmessage="Inscription">


<x-input  name="name" label="Nom complet" />
<x-input  name="email" label="Adresse e-mail"  type="email" />
<x-input  name="password" label="mot de passe" type="password" />
<x-input  name="password_confirmation" label="Confirmation de mot de pass" type="password"  />


</x-auth-layout>
