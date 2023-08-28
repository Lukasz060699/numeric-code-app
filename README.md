
# Generowanie unikalnych kodów 

## Co jest potrzebne do uruchomienia

- PHP
- Apache
- MySQL
- Composer

Należy sklonować lub pobrać projekt z repozytorium. Następnie pobrać zależności przy pomocy ```composer install```. 
Należy zaimportować schemat bazy danych ```numeric-code-app.sql```. Baza powinna działać na porcie ```3306```. Skonfiguruj plik ```.env```.
Wykonaj migracje ```php artisan migrate```. Uruchom serwer deweloperski ```php artisan serve```. 

## Opis aplikacji

Aplikacja została stworzona w frameworku Laravel. Posiada system resjestracji oraz logowania. Istnieją dwa poziomy logowania - użytkownik zalogowany oraz gość.
Bez autoryzacji mamy dostęp jedynie do formularzy rejestracji oraz logowania. Użytkownicy zalogowani są w stanie przeglądać listę wszystkich kodów, a także dokonywać operacji dodawania
i usuwania nowych kodów. 

- Podgląd listy kodów - reprezentuje dane w postaci tabelki z takimi danymi jak: **Id kodu**, **Imię usera**, **Kod**, **Data dodania**. Została dodana paginacja (max 5 rekordów na stronie).
- Dodawanie kodów - użytkownik wybiera w polu typu **number** ilość kodów, które mają zostać wygenerowane. Przy pojedynczym generowaniu można stworzyć od 1 do 10 kodów. Każdy kod jest unikalny. Po dodaniu kodu zostanie wyświetlony komunikat o pomyślnym wygenerowaniu kodów. 
- Usuwanie kodów - użytkownik może usunąć kody poprzez wpisanie je w polu typu **textarea**, oddzielając je przecinkami i/lub od nowej linii. Po pomyślnym usunięciu, zostanie wygenerowany stosowny komunikat.  


