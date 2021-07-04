<?php

include "../templates/temp_start.html";
?>
<h2>Перевод единиц времени</h2>
<?php

class Value{

    private $vals = array(
        "ms" =>  0.0000002778,
        "sec" => 0.0002778,
        "min" => 0.01667,
        "hr" => 1,
        "day" => 24,
        "wk" => 168,
        "mnt" => 730.5,
        "yr" => 8766,
        "cnt" => 876581
    );
    private $valsNames = array(
        "ms" => "Миллисекунды",
        "sec" => "Секунды",
        "min" => "Минуты",
        "hr" => "Часы",
        "day" => "Сутки",
        "wk" => "Неделя",
        "mnt" => "Месяц",
        "yr" => "Года",
        "cnt" => "Столетия"
    );
    function __construct ($namefrom=NULL,$kfrom=NULL,$nameinto=NULL){
        $this->nameFrom = $namefrom;
        $this->kfrom = $kfrom;
        $this->nameInto = $nameinto;
    }
    
    function fromInto(){
        foreach($this->vals as $name=>$val){
            if ($name == $this->nameFrom) {
                $step1 = $this->kfrom * $val;
                $this->FullNamefrom = $this->valsNames[$this->nameFrom];
            }
        }
        foreach($this->vals as $name=>$val){
            if ($name == $this->nameInto) {
                $temp = $this->nameInto;
                $step2 = $step1 / $this->vals[$this->nameInto];
                $this->FullNameinto = $this->valsNames[$this->nameInto];
            }
        }
        return $step2;
    }
    
    function convertInto($step1){
        $step2 = $step1 / $this->k;
        return $step2;
    }
    
    function fromFullName(){
        foreach($this->valsNames as $name=>$full){
            if ($name == $this->nameFrom) {}
        }
    }

    function __destruct() {;}

    function makeOptionsFrom(){

        if ($this->FullNamefrom == NULL) {echo "<option disabled>Из каких единиц:</option>";}
        else {echo "<option selected value={$this->nameFrom}>{$this->FullNamefrom}</option>";}

        foreach($this->valsNames as $name=>$key){    
            if ($this->FullNamefrom != $key){
                echo "[{$name} {$this->FullNameinto}]";
                echo "<option value={$name}>{$key}</option>";
            }
        }
    }

    function makeOptionsInto(){

        if ($this->FullNameinto == NULL) {echo "<option disabled>В какие единицы:</option>";}
        else {echo "<option selected value={$this->nameInto}>{$this->FullNameinto}</option>";}

        foreach($this->valsNames as $name=>$key){
            if ($this->FullNameinto != $key){
                echo "[{$name} {$this->FullNameinto}]";
                echo "<option value={$name}>{$key}</option>";
            }
        }
    }


}

$vfrom = $_POST['value_from'];
$vinto = $_POST['value_into'];
$value = $_POST['valueof'];
$result = $_POST['results'];

$from = new Value($vfrom,$value,$vinto);
$result = $from->fromInto();
$nameinto = $from->FullNameinto;
$namefrom = $from->FullNamefrom;

?>

<table border="0" align=center>
<tr>
<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method='POST'>
    <th><select name='value_from'>
    
    <?php
    /*
    <option disabled>Из чего</option>
    <option selected value=<?= $vfrom; ?>><?= $namefrom; ?></option>
    <option value='m'>Метры</option>
    <option value='km'>Километры</option> ...
    */
    $from->makeOptionsFrom();
    ?></th>

</select><br/>
<th><input type='text' name='valueof' value='<?= $value; ?>'><br/></th>
<tr>
    <th><select name="value_into">
    
    <?php
    /*
    <option disabled>Во что</option>
    <option selected value=<?= $vinto; ?>><?= $nameinto; ?></option>
    <option value='m'>Метры</option> ...
    */
    $from->makeOptionsInto();
    ?>

    </select><br/></th>

<th><input type='submit' name='submit' value='Записать!'/><br/></th>
<th><input type='text' name='results' value='<?= $result; ?>'><br/></th>
</tr>
</table>

</form>

<?php

include "../templates/temp_end.html";
    
?>