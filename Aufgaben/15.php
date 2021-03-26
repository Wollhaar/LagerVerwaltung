<?php

// so lange $data mit md5 verschlusseln bis Summe von alle Zahlen >= 150 ist und dann berechnete md5 zurückschicken.
// z.B. md5('David') -> 464e07afc9e46359fb480839150595c5 -> Summe: 4+6+4+0+7+9+4+6+3+5+9+4+8+0+8+3+9+1+5+0+5+9+5+5 = 119
//dann muss wieder: md5(fca2a7b4619769daff64e4ade3156183) -> fca2a7b4619769daff64e4ade3156183 -> Summe: 2+7+4+6+1+9+7+6+9+6+4+4+3+1+5+6+1+8+3 = 92
//dann muss wieder: md5(cd8f0788d5c3ca461dcd4e05c6c236ca) -> cd8f0788d5c3ca461dcd4e05c6c236ca -> Summe: 8+0+7+8+8+5+3+4+6+1+4+0+5+6+2+3+6 = 76
//dann muss wieder: md5(ad0c775ca939ae1b81c8ce7739b7d0f6) -> ad0c775ca939ae1b81c8ce7739b7d0f6 -> Summe: 0+7+7+5+9+3+9+1+8+1+8+7+7+3+9+7+0+6 = 97
//dann muss wieder: md5(7b352c01c63931f5476c682108296cf6) -> 7b352c01c63931f5476c682108296cf6 -> Summe: 7+3+5+2+0+1+6+3+9+3+1+5+4+7+6+6+8+2+1+0+8+2+9+6+6 = 110
//dann muss wieder: md5(479174d0a20c5941ede53bee77e118ae) -> 479174d0a20c5941ede53bee77e118ae -> Summe: 4+7+9+1+7+4+0+2+0+5+9+4+1+5+3+7+7+1+1+8 = 85
//dann muss wieder: md5(064016cc797933f12f3b560c0f479c47) -> 064016cc797933f12f3b560c0f479c47 -> Summe: 0+6+4+0+1+6+7+9+7+9+3+3+1+2+3+5+6+0+0+4+7+9+4+7 = 103
//dann muss wieder: md5(af513a271be07d2115d069cd1081a221) -> af513a271be07d2115d069cd1081a221 -> Summe: 5+1+3+2+7+1+0+7+2+1+1+5+0+6+9+1+0+8+1+2+2+1 = 65
//dann muss wieder: md5(0102595401dfd0bc124734faabc9fc9b) -> 0102595401dfd0bc124734faabc9fc9b -> Summe: 0+1+0+2+5+9+5+4+0+1+0+1+2+4+7+3+4+9+9 = 66
//dann muss wieder: md5(f5219c6bc40923586e651b4cf399d424) -> f5219c6bc40923586e651b4cf399d424 -> Summe: 5+2+1+9+6+4+0+9+2+3+5+8+6+6+5+1+4+3+9+9+4+2+4 = 107
//dann muss wieder: md5(3995982ecc1645a79077cfd588947789) -> 3995982ecc1645a79077cfd588947789 -> Summe: 3+9+9+5+9+8+2+1+6+4+5+7+9+0+7+7+5+8+8+9+4+7+7+8+9 = 156



function antwort($data) {
    return $data;
}

echo 'Test 0 ' . ($a = 'David') . ' <br> soll: 3995982ecc1645a79077cfd588947789, ist: ' . var_export(antwort($a), true) . '<br><br>';
echo 'Test 1 ' . ($a = 'admin') . ' <br> soll: 8225977d25546979667be66717d768a7, ist: ' . var_export(antwort($a), true) . '<br><br>';
echo 'Test 2 ' . ($a = 'admin1') . ' <br> soll: 795e4488bc86926d866ff0a34998994a, ist: ' . var_export(antwort($a), true) . '<br><br>';
echo 'Test 3 ' . ($a = 'admin2') . ' <br> soll: a778e875279c5d886465275c86706028, ist: ' . var_export(antwort($a), true) . '<br><br>';
echo 'Test 4 ' . ($a = 'anbeca') . ' <br> soll: a974e8d99b6267789f545a819496172d, ist: ' . var_export(antwort($a), true) . '<br><br>';