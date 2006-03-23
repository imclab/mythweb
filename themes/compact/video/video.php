<?php
/**
 * Rudimentary interface to MythVideo data
 *
 * @url         $URL$
 * @date        $Date$
 * @version     $Revision$
 * @author      $Author$
 * @license     GPL
 *
 * @package     MythWeb
 * @subpackage  Video
 *
/**/

// Set the desired page title
    $page_title = 'MythWeb - '.t('Videos');

// Print the page header
    require_once theme_dir.'/header.php';
?>

<SCRIPT LANGUAGE=JAVASCRIPT TYPE="TEXT/JAVASCRIPT">
<!--Hide script from old browsers

function newWindow(newContent)
 {
  winContent = window.open(newContent, 'nextWin', 'right=0, top=20,width=350,height=440, toolbar=no,scrollbars=no, resizable=yes')
 }

 //Stop hiding script from old browsers -->
 </SCRIPT>
<table width="100%" border="0" cellpadding="4" cellspacing="2" class="list small">
<tr class="menu">
<td>
<?php
    echo '<form action="'.root."video\" method=\"GET\">\n";
    echo t('Display') . ": ";
    echo "<select name=\"category\">\n";
    echo '<option value="-1"';
    if( $Filter_Category == -1)
        echo ' SELECTED';
    echo ">All</option>\n";
    foreach (array_keys($Category_String) as $i) {
        echo "<option value=\"$i\"";
        if( $i == $Filter_Category )
            echo ' SELECTED';
        echo '>';
        echo html_entities($Category_String[$i])."</option>\n";
    }
?>
    </select>
    <input type="submit" value="<?php echo t('Update') ?>">
</form>
</td>
</tr>
</table>

<table width="100%" border="0" cellpadding="4" cellspacing="2" class="list small">
<tr class="menu">
<?php   if (show_video_covers) { ?>
    <td><?php echo t('cover') ?></td>
<?php   } ?>
    <td><a href="<?php echo root ?>video?sortby=title"><?php    echo t('title') ?></a></td>
    <td><a href="<?php echo root ?>video?sortby=director"><?php echo t('director') ?></a></td>
    <td><?php echo t('plot')     ?></td>
    <td><a href="<?php echo root ?>video?sortby=category"><?php echo t('category') ?></a></td>
    <td><?php echo t('rating')   ?></a></td>
    <td><?php echo t('IMDB')     ?></a></td>
    <td><a href="<?php echo root ?>video?sortby=length"><?php     echo t('length') ?></a></td>
    <td><a href="<?php echo root ?>video?sortby=userrating"><?php echo t('imdb rating') ?></a></td>
    <td><a href="<?php echo root ?>video?sortby=year"><?php       echo t('year') ?></a></td>
    <td><?php echo t('Edit') ?></a></td>
</tr><?php
    $row = 0;
    foreach ($All_Shows as $show) {
    ?><tr class="recorded">
    <td><?php
        if (show_video_covers && file_exists(video_img_path.'/'.basename($show->coverfile)))
            echo '<a href="'.$show->url.'"><img id="'.html_entities($show->filename).'" src="'.video_img_path.'/'.basename($show->coverfile).'" width="'.video_img_width.'" height="'.video_img_height.'">';
        else
            echo '&nbsp;';
    ?></td>
    <td><?php echo '<a href="'.$show->url.'">'.html_entities($show->title).'</a>' ?></td>
    <td><?php echo $show->director                   ?></td>
    <td><?php echo $show->plot                       ?></td>
    <td><?php echo $Category_String[$show->category] ?></td>
    <td><?php echo $show->rating                     ?></td>
    <td><a href="http://www.imdb.com/Title?<?php echo $show->inetref ?>"><?php echo $show->inetref ?></a></td>
    <td nowrap><?php echo nice_length($show->length * 60) ?></td>
    <td nowrap><?php echo $show->userrating ?></td>
    <td nowrap><?php echo $show->year ?></td>
    <td><a href="javascript:newWindow ('<?php echo root ?>video/edit?intid=<?php echo $show->intid ?>')" ><?php echo t('Edit') ?></a>
<?php
        $row++;
    }
?>

</table>
<?php
    echo '<p align="right" style="padding-right: 75px">'.$row.' videos</p>';


// Print the page footer
    require_once theme_dir.'/footer.php';

    function print_menu_content() {
        if($_GET['sortby'])
            $new_sortby = $_GET['sortby'];
        if ( $_GET['reverse'] == 1 )  {
            $new_reverse = 0;
        } else  {
            $new_reverse = 1;
        }
        if ( $_GET['category'] )
            $new_cat = $_GET['category'];

        echo 'MythVideo:';
        echo "&nbsp; &nbsp;";
        echo '<a href="'.root."video?reverse=$new_reverse";
        if($new_sortby)
            echo "&sortby=$new_sortby";
        if($new_cat)
            echo "&category=$new_cat";
        echo '">';
        echo t('Reverse Order');
        echo "</a>";
    }

