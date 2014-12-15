<?php

\MetaPalettes::removeFields('tl_layout', 'sections', array('sections'));
\MetaPalettes::appendBefore('tl_layout', 'sections', array('flexible_sections'));

$GLOBALS['TL_DCA']['tl_layout']['fields']['flexible_sections'] = array
(
    'label'                   => &$GLOBALS['TL_LANG']['tl_layout']['flexible_sections'],
    'exclude'                 => true,
    'inputType'               => 'multiColumnWizard',
    'save_callback'           => array(
        array('Netzmacht\Contao\FlexibleSections\Dca\Layout', 'autoCompleteSectionIds'),
        array('Netzmacht\Contao\FlexibleSections\Dca\Layout', 'updateLegacySections'),
    ),
    'eval'                    => array(
        'tl_class' => 'clr long',
        'columnFields' => array(
            'label' => array(
                'label'     => &$GLOBALS['TL_LANG']['tl_layout']['flexible_sections_label'],
                'inputType' => 'text',
                'eval'      => array(
                    'style' => 'width: 150px',
                ),
            ),
            'id' => array(
                'label'     => &$GLOBALS['TL_LANG']['tl_layout']['flexible_sections_id'],
                'inputType' => 'text',
                'eval'      => array(
                    'style' => 'width: 130px',
                ),
            ),
            'template' => array(
                'label'     => &$GLOBALS['TL_LANG']['tl_layout']['flexible_sections_template'],
                'inputType' => 'select',
                'options_callback' => array('Netzmacht\Contao\FlexibleSections\Dca\Layout', 'getSectionTemplates'),
                'eval'      => array(
                    'style'               => 'width: 100px',
                    'includeBlankOptions' => true,
                ),
            ),
            'position' => array(
                'label'     => &$GLOBALS['TL_LANG']['tl_layout']['flexible_sections_position'],
                'inputType' => 'select',
                'options'   => array('top', 'before', 'after', 'bottom', 'custom'),
                'reference' => &$GLOBALS['TL_LANG']['tl_layout'],
                'eval'      => array(
                    'style'              => 'width: 200px',
                    'includeblankOption' => true,
                ),
            )
        )
    ),
    'sql'                     => "blob NULL",
);

$GLOBALS['TL_DCA']['tl_layout']['fields']['modules']['load_callback'][] = array(
    'Netzmacht\Contao\FlexibleSections\Dca\Layout',
    'loadSectionLabels'
);