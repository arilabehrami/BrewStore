<section class="sortimet-section">
    <div class="sort-grid">
        <?php
        $emrat = ["Espresso", "Americano", "Cappuccino", "Latte"];
        $çmimet = [
            "Espresso" => 20,
            "Americano" => 25,
            "Cappuccino" => 25,
            "Latte" => 30
        ];

        function printList($title, $array) {
            echo "<div class='sort-box'>";
            echo "<ul>";
            foreach ($array as $k => $v) {
                if (is_numeric($k)) {
                    echo "<li>$v</li>";
                } else {
                    echo "<li>$k: $v &euro;</li>";
                }
            }
            echo "</ul></div>";
        }

        $temp = $emrat; sort($temp); printList("sort()", $temp);
        $temp = $emrat; rsort($temp); printList("rsort()", $temp);
        $temp = $çmimet; asort($temp); printList("asort()", $temp);
        $temp = $çmimet; arsort($temp); printList("arsort()", $temp);
        $temp = $çmimet; ksort($temp); printList("ksort()", $temp);
        $temp = $çmimet; krsort($temp); printList("krsort()", $temp);
        ?>
    </div>
</section>
<style>
/* .sort-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
    gap: 20px;
} */
.sort-box {
    padding: 10px;
    border: 1px solid #ccc;
    border-radius: 10px;
    background-color:#D1B08D;
    color:white;
}
.sort-box h5 {
    margin-top: 0;
}
.sort-box ul {
    list-style: none;
    padding-left: 0;
}
</style>



