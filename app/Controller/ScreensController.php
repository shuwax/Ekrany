<?php
App::uses('AppController', 'Controller');


class ScreensController extends AppController {
    //tabele z bazy  wykorzystane w tym pliku
    var $uses = array('ExEvent','Event', 'User','Screen','Employee','DW_AggregatedStatisticPerDayFromBranch','Department');

    public static $godzina;

    public function ZapisTygodniowy() // zapisanie statystyk tygodniowych z bazy do pliku
    {
        $this->layout = 'ekran1';
        $newTime = date("Y-m-d", strtotime(date("Y-m-d") . " +0 days"));
        $day_number = date('N', strtotime($newTime));
        $start = date("Y-m-d",strtotime(date("Y-m-d")."-".($day_number-1)." days"));
        $stop = date("Y-m-d",strtotime(date("Y-m-d")." -1 days"));
        $departments = $this->Department->find('all');
        foreach ($departments as $item) {
            $dane = $this->DW_AggregatedStatisticPerDayFromBranch->find('all',array(
                'conditions' => array('DW_AggregatedStatisticPerDayFromBranch.Branch =' => $item['Department']['name'], 'DayDate >=' => $start,'DayDate <= ' => $stop),
                'fields' => array('AgentName,sum(`FLLL_working_time_s`)/3600 as FLLL_working_time_s, sum(`Success`) as Success, sum(`Success`)/sum(`FLLL_working_time_s`)*3600 as Srednia'),
                'order'=>array('Srednia'=>'Desc'),
                'group' => array('AgentName'),
                'limit'=>20));
            $f = fopen(APP . 'webroot/Tygodniowy-'.$item['Department']['name'].'.csv', 'w');
            $header = null;
            foreach ($dane as $line) {
                array_push($line['0'], $line['DW_AggregatedStatisticPerDayFromBranch']['AgentName']);
                fputcsv($f, $line['0'], ",");
            }
            fclose($f);
        }
    }

    public function ZapisObecny($dane,$iddep)
    {
        $departments = $this->Department->findById($iddep);
        $f = fopen(APP . 'webroot/Obecny-' . $departments['Department']['name'] . '.csv', 'w');
        $header = null;
        foreach ($dane as $line) {
            //array_push($line['0'], $line['0']['0']);
            fputcsv($f, $line, ",");
        }
        fclose($f);

    }

    public function ZapisDzienny() // zapisanie statystyk dziennych  z bazy do pliku
    {
        $newTime = date("Y-m-d",strtotime(date("Y-m-d")." -1 days"));
        $day_number = date('N', strtotime($newTime));
        if($day_number ==7)
        {
            $newTime = date("Y-m-d",strtotime(date("Y-m-d")." -2 days"));
        }
        $this->set('aktualnadata',$newTime);
        $departments = $this->Department->find('all');
        foreach ($departments as $item) {
            $dane = $this->DW_AggregatedStatisticPerDayFromBranch->find('all',array(
                'conditions' => array('DW_AggregatedStatisticPerDayFromBranch.Branch =' => $item['Department']['name'], 'DayDate =' => $newTime),
                'fields' => array('AgentName,sum(`FLLL_working_time_s`)/3600 as FLLL_working_time_s, sum(`Success`) as Success, sum(`Success`)/sum(`FLLL_working_time_s`)*3600 as Srednia'),
                'order'=>array('Srednia'=>'Desc'),
                'group' => array('AgentName'),
                'limit'=>20));

            $f = fopen(APP . 'webroot/Dzienny-'.$item['Department']['name'].'.csv', 'w');
            $header = null;
            foreach ($dane as $line) {
                array_push($line['0'], $line['DW_AggregatedStatisticPerDayFromBranch']['AgentName']);
                fputcsv($f, $line['0'], ",");
            }
            fclose($f);
        }
    }
    public function OtwarciePliku($id=null) // pobranie - otworzenie pliku excel godzinowego z Google
    {
        $dane = $this->Screen->findByid($id);
        $depname = $this->Department->findByid($dane['Screen']['depid']);

        if(!ini_set('default_socket_timeout', 15)) echo "<!-- unable to change socket timeout -->";
        if (($handle = fopen($depname['Department']['google'], "r")) !== FALSE) {
            while (($data1 = fgetcsv($handle, 1000, ",")) !== FALSE) {
                $spreadsheet_data[] = $data1;
            }
            fclose($handle);
            $file = file_get_contents($depname['Department']['google']);
            $data1 = array_map("str_getcsv", preg_split('/\r*\n+|\r+/', $file));
            $this::ZapisObecny($data1,$dane['Screen']['depid']);
            return $data1;
        }
    }
    public function OtwarcieTygodniowego($dpid) // otwarcie pliku zawierającego statystyki tygodniowe
    {
        $depname = $this->Department->findByid($dpid);
        $depname = $depname['Department']['name'].'.csv';
        $plik = APP . 'webroot/'.'Tygodniowy-'.$depname;
        if(!ini_set('default_socket_timeout', 15)) echo "<!-- unable to change socket timeout -->";
        if (($handle = fopen($plik, "r")) !== FALSE) {
            while (($data1 = fgetcsv($handle, 1000, ",")) !== FALSE) {
                $spreadsheet_data[] = $data1;
            }
            fclose($handle);
            $file = file_get_contents($plik);
            $data1 = array_map("str_getcsv", preg_split('/\r*\n+|\r+/', $file));
            return $data1;
        }
    }

    public function OtwarcieObecnego($dpid) // otwarcie pliku zawierającego statystyki tygodniowe
    {
        $depname = $this->Department->findByid($dpid);
        $depname = $depname['Department']['name'].'.csv';
        $plik = APP . 'webroot/'.'Obecny-'.$depname;
        if(!ini_set('default_socket_timeout', 15)) echo "<!-- unable to change socket timeout -->";
        if (($handle = fopen($plik, "r")) !== FALSE) {
            while (($data1 = fgetcsv($handle, 1000, ",")) !== FALSE) {
                $spreadsheet_data[] = $data1;
            }
            fclose($handle);
            $file = file_get_contents($plik);
            $data1 = array_map("str_getcsv", preg_split('/\r*\n+|\r+/', $file));
            return $data1;
        }
    }

    public function OtwarcieDziennego($dpid) // otwarcie pliku zawierającego statystyki dzienne(jeden wstecz)
    {
        $depname = $this->Department->findByid($dpid);
        $depname = $depname['Department']['name'].'.csv';
        $plik = APP . 'webroot/'.'Dzienny-'.$depname;
        if(!ini_set('default_socket_timeout', 15)) echo "<!-- unable to change socket timeout -->";
        if (($handle = fopen($plik, "r")) !== FALSE) {
            while (($data1 = fgetcsv($handle, 1000, ",")) !== FALSE) {
                $spreadsheet_data[] = $data1;
            }
            fclose($handle);
            $file = file_get_contents($plik);
            $data1 = array_map("str_getcsv", preg_split('/\r*\n+|\r+/', $file));
            return $data1;
        }
    }
    public function getEkrany() // zwraca wszystkie dane wszystkich ekranów
    {
        $ekrany = $this->Screen->find('all');
        return $ekrany;
    }
    public function getGodzina() // zwraca godzine do raprotu biezacego
    {
        return self::$godzina;
    }
    public function getEkranID($id = null) // zwraca informacje o wybranym ekranie
    {
        $ekran = $this->Screen->findByid($id);
        return $ekran;
    }

    public function zwiekszlicznik($licz) // licznik wykorzystywany do zmiany planszy na ekranie
    {
        $licz = intval($licz);
        $licz++;
        if($licz<=0 || $licz>9)
        {
            $licz = 1;
        }
        return $licz;
    }
    public function Przyciecie($tablica, $zwiekszyid,&$srednia)
    {
        $key = array_keys(array_column($tablica, 32),self::$Trenerzy[$zwiekszyid]);
        $pom= array();
        $suma = 0;
        for($i=0;$i<count($key);$i++)
        {
            array_push($pom,$tablica[$key[$i]]);
            $suma = $suma+ floatval(str_replace(",",".",$tablica[$key[$i]][4]));
        }
        if(count($key)!=0)
            $srednia = $suma/count($key);
        else
            $srednia = 0;
        return $pom;
    }

    public function EkranBialystok($idG = null) //Logika ekranów Białystok
    {

        $dane = $this->Screen->findByid($idG); // znajdz ekran po przekazanym id
        $datazmianyGoogle = $dane['Screen']['aktualizacjaGoogle']; // czas ostatniej aktualizacji danych z serwera wojtka
        $dt = new DateTime($datazmianyGoogle);  // stworzenie obiektu datatime na podstawie aktualnej daty
        $godzinabaza = $dt->format('H');
        $godzinateraz = $aktualnyCzas = date("H");
        $minutateraz = intval($aktualnyCzas = date("i"));

        $this->layout = 'ekran1pbx';

        if($godzinabaza == $godzinateraz )
        {
            if($minutateraz%5 == 0) {
                $this->OtwarciePliku($idG);
                $tablica = $this::OtwarcieObecnego($dane['Screen']['depid']);
            }
            else
            {
                $tablica = $this::OtwarcieObecnego($dane['Screen']['depid']);
                // CakeLog::write('debug', 'myArray'.print_r( "OdczytPliku", true) );
            }
        }else
        {
            $this->OtwarciePliku($idG);
            $tablica = $this::OtwarcieObecnego($dane['Screen']['depid']);
            $nowatablica = array('Screen' => (array('id' => $idG, 'aktualizacjaGoogle' =>  date('Y-m-d H:i:s'))));
            // CakeLog::write('debug', 'myArray'.print_r( "Aktualizacja", true) );
            $this->Screen->save($nowatablica);
        }

        $this->set('systell',$tablica);
        self::$godzina = $tablica[0][4];
        $this->render('Statystykiobecnepbx');
    }
    public function Ekran($idG = null) // cała logika ekranów
    {
        // Zmienne pomocnicze
        $dane = $this->Screen->findByid($idG); // znajdz ekran po przekazanym id
        $cowyswietlic = $dane['Screen']['conntentnumber']; // co aktyalnie jest wyswietlane 0 - bierzacy 1-konkurs 2-tygodniowy 3-dzienny
        $aktualnaData = date("Y-m-d"); // dzisiejsza data
        $aktualnyCzas = date("H:i"); // dzisiejszy czas
        // $DziewiataCzas = date("H:i","09:00");
        $numer = date("Y-m-d", strtotime(date("Y-m-d") . " +0 days")); // numer tygodnia poniedzialek - 1 wtorek - 2
        $numer_dzien = date('N', strtotime($numer)); // dokladnie to samo co wyzej tylko z przypisaniem zmiennej
        $newTime = date("i", strtotime(date("H:i") . " -0 minutes"));
        $depname = $this->Department->findByid($dane['Screen']['depid']);

        // zaktualizacja popranych danych(raz dziennie)
        $datazmiany = $dane['Screen']['aktualizacja']; // czas ostatniej aktualizacji danych z serwera wojtka
        $dt = new DateTime($datazmiany);  // stworzenie obiektu datatime na podstawie aktualnej daty
        $samadata = $dt->format('Y-m-d'); // uciecie godziny
        $aktualna = date("Y-m-d"); // aktualna data



        $datazmianyGoogle = $dane['Screen']['aktualizacjaGoogle']; // czas ostatniej aktualizacji danych z serwera wojtka
        $dt = new DateTime($datazmianyGoogle);  // stworzenie obiektu datatime na podstawie aktualnej daty
        //$samadata = $dt->format('H'); // uciecie godziny
        $samadata = $dt->format('i'); // uciecie godziny
        $aktualna = date("Y-m-d"); // aktualna data

        //$dt->add(new DateInterval('PT1H'));
        $godzinabaza = $dt->format('H');
        $minutabaza = $dt->format('i');
        $godzinateraz = $aktualnyCzas = date("H");
        $minutateraz = intval($aktualnyCzas = date("i"));





        /*
       if ($aktualna != $samadata) // sprawdzenie daty ostatniej aktualizacji, ma byc robiona raz dziennie
       {

           $this->ZapisDzienny(); // wywołanie metody zapis dzienny patrz wyzej
           $this->ZapisTygodniowy(); // wywołanie metody zapis dzienny patrz wyzej
           $nowatablica = array('Screen' => (array('id' => $idG, 'aktualizacja' => date('Y-m-d H:i:s')))); // zapis nowej daty aktualizacji do bazy
           $this->Screen->save($nowatablica); // wykonanie zapisania
       }
       */

        //zmiana planszy co trzy wyswietlenia
        $liczba = $dane['Screen']['liczba']; // co aktualnie jest wyswietlanie
        $zwiekszonyLicznik = $this->zwiekszlicznik($liczba); // zwiekszenie licznika


        if ($depname['Department']['link'] == 1)  // jesli oddział ma przypisany link do google wyzwietl go
        {               //wyswietlac bedzie biezacy

            if ($zwiekszonyLicznik >= 1 && $zwiekszonyLicznik <= 3 && $cowyswietlic != 1 && $numer_dzien != 1) {
                $cowyswietlic = 2;//tygodniowy
            } else if ($zwiekszonyLicznik >= 4 && $zwiekszonyLicznik <= 6 && $cowyswietlic != 1 && $numer_dzien != 1) {
                $cowyswietlic = 3; //dzienny wstecz
            }
            else if($numer_dzien == 1 && $cowyswietlic != 1)//jesli jest poniedzialek wyswietl ostatna sobote i bierzacy
            {
                if( $zwiekszonyLicznik <=3)
                    $cowyswietlic = 3;
                else
                    $cowyswietlic = 0;
            }else if($numer_dzien != 1 && $cowyswietlic != 1)
            {
                $cowyswietlic = 0;
            }
        } else {
            if ($zwiekszonyLicznik >= 1 && $zwiekszonyLicznik <= 3 && $cowyswietlic != 1 && $numer_dzien != 1 && $cowyswietlic != 1) {
                $cowyswietlic = 2;

            } else if ($cowyswietlic != 1) {
                $cowyswietlic = 3;
            }
        }

        //$zwiekszonyLicznik = 5;
        $cowyswietlic = 0;
        $nowatablica = array('Screen' => (array('id' => $idG, 'conntentnumber' => $cowyswietlic, 'liczba' => $zwiekszonyLicznik)));
        $this->Screen->save($nowatablica);


        if ($cowyswietlic == 0  && $idG != 4) // Statystyki obecne
        {
            $this->layout = 'ekran1';


            if($godzinabaza == $godzinateraz )
            {
                if($minutateraz%5 == 0) {
                    $this->OtwarciePliku($idG);
                    $tablica = $this::OtwarcieObecnego($dane['Screen']['depid']);
                   // CakeLog::write('debug', 'myArray'.print_r( "Pobranie", true) );
                }
                else
                {
                    $tablica = $this::OtwarcieObecnego($dane['Screen']['depid']);
                   // CakeLog::write('debug', 'myArray'.print_r( "OdczytPliku", true) );
                }
            }else
            {
                $this->OtwarciePliku($idG);
                $tablica = $this::OtwarcieObecnego($dane['Screen']['depid']);
                $nowatablica = array('Screen' => (array('id' => $idG, 'aktualizacjaGoogle' =>  date('Y-m-d H:i:s'))));
               // CakeLog::write('debug', 'myArray'.print_r( "Aktualizacja", true) );
                $this->Screen->save($nowatablica);
            }

            $this->set('systell',$tablica);
            self::$godzina = $tablica[0][7];
            if($idG == 1)
            {
                $this->render('Statystykiobecnenewos');
            }else
            $this->render('Statystykiobecne');
        }
        else if($cowyswietlic == 0  &&  $idG == 4) { //PBX

            $this->layout = 'ekran1pbx';
            if($godzinabaza == $godzinateraz )
            {
                if($minutateraz%5 == 0) {
                    $this->OtwarciePliku($idG);
                    $tablica = $this::OtwarcieObecnego($dane['Screen']['depid']);
                }
                else
                {
                    $tablica = $this::OtwarcieObecnego($dane['Screen']['depid']);
                    // CakeLog::write('debug', 'myArray'.print_r( "OdczytPliku", true) );
                }
            }else
            {
                $this->OtwarciePliku($idG);
                $tablica = $this::OtwarcieObecnego($dane['Screen']['depid']);
                $nowatablica = array('Screen' => (array('id' => $idG, 'aktualizacjaGoogle' =>  date('Y-m-d H:i:s'))));
                // CakeLog::write('debug', 'myArray'.print_r( "Aktualizacja", true) );
                $this->Screen->save($nowatablica);
            }

            $this->set('systell',$tablica);
            self::$godzina = $tablica[0][4];
            $this->render('Statystykiobecnepbx');

        }
        else if($cowyswietlic == 1) { // konkurs

            $daneEventu = $this->Event->findByid($dane['Screen']['idevent']);
            $zmieniarka = strtotime($daneEventu['Event']['czas']);
            $czasEventu = date("H:i", strtotime('+0 minutes', $zmieniarka));
            $dataEventu = date("Y-m-d",$zmieniarka);
            if  ($aktualnyCzas<$czasEventu && (strcmp($dataEventu,$aktualnaData))==0) {
                $this->layout = 'konkurs';
                $this->set('event', $daneEventu);
                $this->render('Konkurs');
            }else
            {
                $this->layout = 'ekran1';
                $nowatablica = array('Screen' => (array('id' => $idG,'conntentnumber'=>2,'liczba'=>1)));
                $this->Screen->save($nowatablica);
                $ekrandane = $this->Screen->findByid($idG);
                $dane = $this->OtwarcieTygodniowego($ekrandane['Screen']['depid']);
                array_pop($dane);
                $this->set('systell',$dane);
                $this->render('Statystyki_tygodniowe');

            }
        }else if($cowyswietlic == 2) // statystyki tygodniowe
        {
            $this->layout = 'ekran1';
            $ekrandane = $this->Screen->findByid($idG);
            $dane = $this->OtwarcieTygodniowego($ekrandane['Screen']['depid']);
            array_pop($dane);
            $this->set('systell',$dane);
            $this->render('Statystyki_tygodniowe');
        }
        else{ // statystyki dzienne(dzien wczesniej)
            $this->layout = 'ekran1';
            $ekrandane = $this->Screen->findByid($idG);
            $dane = $this->OtwarcieDziennego($ekrandane['Screen']['depid']);
            array_pop($dane);
            $this->set('systell',$dane);
            $this->render('Statystykidzienne');
        }
    }

    public function index() { // wyswietlenie wszystkich ekranów
        $this->set('ekrany',$this->Screen->find('all'));
        $this->set('department',$this->Department->find('all'));
    }

    public function add() { //dodanie ekranu
        $this->set('states',$this->Department->find('list'));
        if ($this->request->is('post')) {
            $this->Screen->create();
            if ($this->Screen->save($this->request->data)) {
                $this->Flash->success(__('Ekran Został dodany'));
                return $this->redirect(array('action' => 'index'));
            } else {
                $this->Flash->error(__('Błąd podczas dodawania ekranu.'));
            }
        }
    }

    public function delete($id = null) { // usuwanie wybranego ekranu

        $this->Screen->id = $id;
        $this->request->allowMethod('post', 'delete');
        if ($this->Screen->delete()) {
            $this->Flash->success(__('Ekran został usunięty'));
        } else {
            $this->Flash->error(__('Ekran nie został usunięty, błąd podczas usuwania'));
        }
        return $this->redirect(array('action' => 'index'));

    }

}
