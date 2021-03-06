<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>

<?php
include ('buildproperties.php');

// TODO: copied from logs.php. Should be in common utilities for reuse
function fileSizeForDisplay($filename) {
    $onekilo=1024;
    $onemeg=$onekilo * $onekilo;
    $criteria = 10 * $onemeg;
    $scaleChar = " ";
    if (file_exists($filename)) {
        $zipfilesize=filesize($filename);
        if ($zipfilesize > $criteria) {
            $zipfilesize=round($zipfilesize/$onemeg, 0);
            $scaleChar = " MB";
        }
        else {
            if ($zipfilesize > $onekilo) {
                $zipfilesize=round($zipfilesize/$onekilo, 0);
                $scaleChar = " KB";
            } else {
                // use raw size in bytes if less that one 1K
                $scaleChar = " B";
            }
        }
    }
    else {
        $zipfilesize = 0;
    }
    $result =  "(" . $zipfilesize . $scaleChar . ")";
    return $result;
}

function listLogs($myDir) {

    $aDirectory = dir($myDir);
    $index = 0;
    $cdir = getcwd();
    while ($anEntry = $aDirectory->read()) {
        $path = $cdir . "/" . $myDir . "/" . $anEntry;
        if (is_file($path)) {
            $entries[$index] = $anEntry;
            $index++;
        }
    }

    $aDirectory->close();
    if (!empty($entries)) {
        sort($entries);
    }

    if ($index < 0) {
        echo "<br>There are no logs for this build.";
        return;
    }
    for ($i = 0; $i < $index; $i++) {
        $anEntry = $entries[$i];
        $line = "<td><a href=\"$myDir/$anEntry\">$anEntry</a>" . fileSizeForDisplay("$myDir/$anEntry") . "</td>";
        echo "<li>$line</li>";
    }
}


?>
<STYLE TYPE="text/css">
<!--
P {text-indent: 30pt;}
-->
</STYLE>


<title>Drop Test Results</title>
                                                                   <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
                                                                   <meta name="author" content="Eclipse Foundation, Inc." />
                                                                   <meta name="keywords" content="eclipse,project,plug-ins,plugins,java,ide,swt,refactoring,free java ide,tools,platform,open source,development environment,development,ide" />
                                                                   <link rel="stylesheet" type="text/css" href="../../../eclipse.org-common/stylesheets/visual.css" media="screen" />
                                                                   <link rel="stylesheet" type="text/css" href="../../../eclipse.org-common/stylesheets/layout.css" media="screen" />
                                                                   <link rel="stylesheet" type="text/css" href="../../../eclipse.org-common/stylesheets/print.css" media="print" />
<script type="text/javascript">

sfHover = function() {
    var sfEls = document.getElementById("leftnav").getElementsByTagName("LI");
    for (var i=0; i<sfEls.length; i++) {
        sfEls[i].onmouseover=function() {
            this.className+=" sfhover";
        }
        sfEls[i].onmouseout=function() {
            this.className=this.className.replace(new RegExp(" sfhover\\b"), "");
        }
    }
}
if (window.attachEvent) window.attachEvent("onload", sfHover);
</script>
</head>
<body>
<div id="header">
                                                                   <a href="/"><img src="../../../eclipse.org-common/stylesheets/header_logo.gif" width="163" height="68" border="0" alt="Eclipse Logo" class="logo" /></a>
                                                                   <div id="searchbar">
                                                                                                                                   <img src="../../../eclipse.org-common/stylesheets/searchbar_transition.gif" width="92" height="26" class="transition" alt="" />
                                                                                                                                   <img src="../../../eclipse.org-common/stylesheets/searchbar_header.gif" width="64" height="17" class="header" alt="Search" />
                                                                                                                                   <form method="get" action="/search/search.cgi">
                                                                                                                                                                                                   <input type="hidden" name="t" value="All" />
                                                                                                                                                                                                   <input type="hidden" name="t" value="Doc" />
                                                                                                                                                                                                   <input type="hidden" name="t" value="Downloads" />
                                                                                                                                                                                                   <input type="hidden" name="t" value="Wiki" />
                                                                                                                                                                                                   <input type="hidden" name="wf" value="574a74" />
                                                                                                                                                                                                   <input type="text" name="q" value="" />
                                                                                                                                                                                                   <input type="image" class="button" src="../../../eclipse.org-common/stylesheets/searchbar_submit.gif" alt="Submit" onclick="this.submit();" />
                                                                                                                                   </form>
                                                                   </div>
                                                                   <ul id="headernav">
                                                                                                                                   <li class="first"><a href="/org/foundation/contact.php">Contact</a></li>
                                                                                                                                   <li><a href="/legal/">Legal</a></li>
                                                                   </ul>
</div>
<div id="topnavsep"></div>
</div>


</div>
<div id="topnavsep"></div>
<div id="leftcol">
<ul id="leftnav">
<li><a href="logs.php">Logs</a></li>
<li><a href="testResults.php#UnitTest">Unit Test Results</a></li>
<li><a href="testResults.php#PluginsErrors">Plugins Containing Compile Errors</a></li>

  </li>
  <li style="background-image: url(../../../eclipse.org-common/stylesheets/leftnav_fade.jpg); background-repeat: repeat-x; border-style: none;">
                                                                                                  <br /><br /><br /><br /><br />
  </li>
</ul>

</div>



<div id="midcolumn">
<div class="homeitem3col">
<?php
echo "<title>Release Engineering logs for $BUILD_ID</title>\n";

echo "<h3>Release Engineering Logs for $BUILD_ID</h3>\n";
?>

<?php
listLogs("buildlogs");
?>

<?php
echo "<h3>Comparator Logs for $BUILD_ID</h3>\n";
echo "<p>For explaination, see <a href=\"http://wiki.eclipse.org/Platform-releng/Platform_Build_Comparator_Logs\">Platform Build Comparator Logs</a> wiki.</p>\n";
listLogs("buildlogs/comparatorlogs");
?>

</li>
</ul>
</div>
</div>
</br></br></br>
<div id="footer">
                                                                   <ul id="footernav">
                                                                                                                                   <li class="first"><a href="/">Home</a></li>
                                                                                                                                   <li><a href="/legal/privacy.php">Privacy Policy</a></li>
                                                                                                                                   <li><a href="/legal/termsofuse.php">Terms of Use</a></li>
                                                                   </ul>
                                                                   <p>Copyright &copy; 2006 The Eclipse Foundation. All Rights
Reserved</p>
</div>
</body>
</html>

