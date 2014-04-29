<?php
// no direct access
defined( '_JEXEC' ) or die( 'Restricted access' );

class PlgContentBibbase extends JPlugin {

    public function onContentPrepare($context, &$row, &$params, $page = 0) {
        $row->text = $this->replaceBibbaseTags($row->text);
    }

    private function replaceBibbaseTags($text) {
        return preg_replace_callback(
                '(\{bibbase\}\s*(\S+)\s*\{/bibbase\})',
                array($this, 'replaceCallback'),
                $text);
    }

    private function replaceCallback($matches) {
        $biburl = 'http://bibbase.org/show?bib=' . urlencode(html_entity_decode($matches[1]));
        return file_get_contents($biburl);
    }
}
?>
