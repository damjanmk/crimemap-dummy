<?php

function selo($zbor)
{
    if (mb_strpos($zbor, "с.", null, "UTF-8") === 0 || mb_strpos($zbor, "село", null, "UTF-8") === 0 || mb_strpos($zbor, "с,", null, "UTF-8") === 0)
        return TRUE;
}

function tire($s)
{
    if (($t = mb_strpos($s, "-", null, "UTF-8") ) !== FALSE)
        return $t;
    if (( $t = mb_strpos($s, "—", null, "UTF-8") ) !== FALSE)
        return $t;
    if (( $t = mb_strpos($s, "–", null, "UTF-8") ) !== FALSE)
        return $t;
    return FALSE;
}

function prva_mala($zbor)
{
    $prva = mb_substr($zbor, 0, 1, "UTF-8");
    return mb_strtolower($prva, "UTF-8") == $prva;
}

function selo_info($selo_plus, &$n)
{
    global $grad_mapa;
    $selo = "";
    $grad = FALSE;
    $t = FALSE;
    $selo_plus_trim = $selo_plus;
    for ($i = 0; $i < count($selo_plus_trim); $i++)
    {
        if ($selo_plus[0] == "с.")
        {
            $selo = "с.";
            continue;
        }
        $selo_plus_trim[$i] = trim($selo_plus_trim[$i], " ,.");
        if (($t = tire($selo_plus_trim[$i])) !== FALSE)
        {
            for ($j = 0; $j < $i; $j++)
            {
                $selo .= $selo_plus_trim[$j] . " ";
            }
            $selo .= mb_substr($selo_plus_trim[$i], 0, $t, "UTF-8");
            if ($n->nema_grad())
            {
                $grad = trim(mb_substr($selo_plus_trim[$i], $t + 1, mb_strlen($selo_plus_trim[$i]) - $t, "UTF-8"), " ,.");
                $ok = FALSE;
                foreach ($grad_mapa as $ime_grad => $ime_gradsko)
                {
                    if ($grad == $ime_grad)
                    {
                        $ok = TRUE;
                        break;
                    }
                    if ($grad == $ime_gradsko)
                    {
                        $grad = $ime_grad;
                        $ok = TRUE;
                        break;
                    }
                }
                if (!$ok)
                {
                    $grad = FALSE;
                }
            }
            break;
        }
        else
        {
            if ($i > 0 && $grad === FALSE)
            {
                if ($selo_plus_trim[$i] != "")
                    $grad = grad($selo_plus_trim[$i]);
            }
        }
    }
    if (!$t)
    {
        $i = 0;
        $selo = $selo_plus[0];
        if (mb_strpos($selo, "село", null, "UTF-8") !== FALSE)
        {
            if (mb_strpos($selo, ".", null, "UTF-8") == mb_strlen($selo, "UTF-8") - 1)
                return;
            if (prva_mala($selo_plus_trim[1]))
                return;
            else
            {
                $selo = "с." . $selo_plus_trim[1];
                $i = 1;
            }
        }
        if ($i == 0)
        {
            if ($selo == "с." || $selo == "с,")
            {
                $selo .= " " . $selo_plus_trim[1];
                $i = 1;
            }
        }
        if (mb_strpos($selo, "Горно", null, "UTF-8") !== FALSE ||
                mb_strpos($selo, "Долно", null, "UTF-8") !== FALSE ||
                mb_strpos($selo, "Ново", null, "UTF-8") !== FALSE ||
                mb_strpos($selo, "Старо", null, "UTF-8") !== FALSE ||
                mb_strpos($selo, "Долна", null, "UTF-8") !== FALSE ||
                mb_strpos($selo, "Горна", null, "UTF-8") !== FALSE)
        {
            $selo .= " " . $selo_plus_trim[$i + 1];
        }
    }
    if ($selo != "")
        $n->set_adresa(trim($selo, " ,"));
    if ($grad !== FALSE)
        $n->set_grad($grad);
}

function kraj($u)
{
    $l = mb_strlen($u, "UTF-8") - 1;
    if (mb_strpos($u, "“", null, "UTF-8") === $l ||
            mb_strpos($u, "\"", null, "UTF-8") === $l ||
            mb_strpos($u, "„", null, "UTF-8") === $l)
        return true;
    if (mb_substr_count($u, "\"", "UTF-8") === 2 ||
            mb_substr_count($u, "„", "UTF-8") === 2)
        return true;
    return false;
}

function ul($zbor)
{
    if (mb_strpos($zbor, "ул.", null, "UTF-8") === 0 || mb_strpos($zbor, "бул.", null, "UTF-8") === 0)
        return TRUE;
}

function ul_info($ul_plus, &$n)
{
    $ulica = "";
    $ok = FALSE;
    foreach ($ul_plus as $u)
    {
        $u_trim = trim($u, "\xC2\xA0,.");
        //$u_trim = trim(trim($u, " "), ",");
        $ulica .= $u_trim . " ";
        if (kraj($u_trim))
        {
            $ok = TRUE;
            break;
        }
    }
    if ($ok)
        $n->set_adresa(trim($ulica));
    else
    {
        $ulica = "";
        foreach ($ul_plus as $u)
        {
            $ulica .= $u . " ";
            if (mb_strpos($u, ",", null, "UTF-8") == mb_strlen($u, "UTF-8") - 1)
            {
                $ok = TRUE;
                break;
            }
        }
        if ($ok)
            $n->set_adresa(trim($ulica, " ,"));
    }
}

?>
