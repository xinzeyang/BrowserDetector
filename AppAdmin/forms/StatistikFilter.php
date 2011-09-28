<?php
/**
 * Form
 *
 * PHP version 5
 *
 * @category  CreditCalc
 * @package   Form
 * @author    Thomas Mueller <t_mueller_stolzenhain@yahoo.de>
 * @copyright 2007-2010 Unister GmbH
 * @version   SVN: $Id$
 */

/**
 * Form
 *
 * @category  CreditCalc
 * @package   Form
 * @author    Thomas Mueller <t_mueller_stolzenhain@yahoo.de>
 * @copyright 2007-2010 Unister GmbH
 */
class KreditAdmin_Form_StatistikFilter extends KreditCore_Class_FormAbstract
{
    /**
     * Initialisierung der Form
     *
     * @return void
     * @access public
     */
    public function init()
    {
        parent::init();

        //Name der Form
        $name = 'creditStat';

        //Parameter der Form
        $this->setMethod('post');
        $this->setOptions(array('class' => 'optionForm'));
        $this->setAttrib('action', 'javascript:void();');
        $this->setAttrib(
            'onsubmit',
            'var newUrl=rewriteOverviewUrl();if(newUrl) {jQuery(\'#other\')' .
            '.load(newUrl);} return false;'
        );
        $this->setAttrib('id', $name);
        $this->setAttrib('name', $name);

        $dateStartElement = new KreditCore_Class_Form_Element_Text('filterDateStart');
        $dateStartElement
            ->setLabel('Von:')
            ->setValue(date('01.m.Y'))
            ->setAttrib('class', 'jqDatePicker');

        $dateEndElement = new KreditCore_Class_Form_Element_Text('filterDateEnd');
        $dateEndElement
            ->setLabel('Bis:')
            ->setValue(date('d.m.Y'))
            ->setAttrib('class', 'jqDatePicker');

        $intervalElement = new KreditCore_Class_Form_Element_Select('groupValue');
        $intervalElement
            ->setLabel('Intervall:')
            ->addMultiOptions(
                array(
                    40 => 'Stunde',
                    30 => 'Tag',
                    20 => 'Woche',
                    10 => 'Monat',
                    50 => 'Jahr'
                )
            )
            ->setValue(10);


        $partnerElement = new KreditCore_Class_Form_Element_Select('portale');
        $partnerElement
            ->setLabel('Partner:')
            ->setAttrib('size', '8')
            ->setAttrib('multiple', 'multiple')
            ->setAttrib('onchange', 'updateCampaigns(this);');

        $partnerModel = new \App\Model\PartnerSites();
        $select       = $partnerModel->select();

        if (null !== $select) {
            $partnerList  = $partnerModel->fetchAll($select->order('name'));
            $partnerElement->addMultiOption('-1', 'Alle');
            foreach ($partnerList as $partner) {
                $partnerElement->addMultiOption($partner['p_id'], $partner['name']);
            }
        }

        $campaignElement = new KreditCore_Class_Form_Element_MultiSelect('campaigns');
        $campaignElement
            ->setLabel('Kampagne:')
            ->setAttrib('multiple', 'multiple')
            ->setAttrib('size', '8');

        /*
        $campaignModel = new \App\Model\Campaigns();
        $select        = $campaignModel->select();
        $campaigns     = $campaignModel->fetchAll($select->where('p_id = ?', -1)->order('name'));
        */

        $categoriesElement = new KreditCore_Class_Form_Element_Select('sparteValue');
        $categoriesElement
            ->setLabel('Categories:')
            ->setAttrib('size', '8')
            ->setValue(1);

        $categoriesModel = new \App\Model\Categories();
        $categoriesList  = $categoriesModel->fetchAll();
        foreach ($categoriesList as $sparte) {
            $categoriesElement->addMultiOption($sparte['idCategories'], $sparte['name']);
        }

        $submitElement = new KreditCore_Class_Form_Element_Submit('submit');
        $submitElement->setLabel('Statistik anzeigen');
        $submitElement->setIgnore(true);

        $downloadElement = new KreditCore_Class_Form_Element_Submit('download');
        $downloadElement->setLabel('Statistik downloaden');
        $downloadElement->setIgnore(true);
        $downloadElement->setAttrib(
            'onclick',
            'var newUrl=rewriteOverviewUrl().replace(/overview/, ' .
            '\'export-csv\'); window.open(newUrl); return false;'
        );

        $typeClickoutElement = new KreditCore_Class_Form_Element_MultiCheckbox('clickouts');
        $typeClickoutElement->setLabel('');
        $typeClickoutElement->setOptions(array('escape' => false));
        $options = array(
            'clickout,Institute_Click,Anzahl Clickouts' => 'Anzahl',
            'clickout,Institute_Summary,Kreditsumme Clickouts' => 'Kreditsumme',
            'clickout,Institute_SummaryPercent,&empty; Kreditsumme Clickouts' => '&empty; Kreditsumme',
            'clickout,Institute_TimePercent,&empty; Laufzeit Clickouts' => '&empty; Laufzeit'
        );
        foreach ($options as $key => $value) {
            $typeClickoutElement->addMultiOption($key, $value);
        }
        $typeClickoutElement->setValue('clickout,Institute_Click,Anzahl Clickouts');

        $typeClickoutSaleElement = new KreditCore_Class_Form_Element_MultiCheckbox('clickoutsales');
        $typeClickoutSaleElement->setLabel('');
        $typeClickoutSaleElement->setOptions(array('escape' => false));
        $options = array(
            'clickoutsale,Institute_Click,Anzahl Clickouts (Internal)' => 'Anzahl',
            'clickoutsale,Institute_Summary,Kreditsumme Clickouts (Internal)' => 'Kreditsumme',
            'clickoutsale,Institute_SummaryPercent,&empty; Kreditsumme Clickouts (Internal)' => '&empty; Kreditsumme',
            'clickoutsale,Institute_TimePercent,&empty; Laufzeit Clickouts (Internal)' => '&empty; Laufzeit'
        );
        foreach ($options as $key => $value) {
            $typeClickoutSaleElement->addMultiOption($key, $value);
        }
        $typeClickoutSaleElement->setValue('clickoutsale,Institute_Click,Anzahl Clickouts (Internal)');

        $typeSaleElement = new KreditCore_Class_Form_Element_MultiCheckbox('sales');
        $typeSaleElement->setLabel('');
        $typeSaleElement->setOptions(array('escape' => false));
        $options = array(
            'sale,Institute_Click,Anzahl Sales' => 'Anzahl',
            'sale,Institute_Summary,Kreditsumme Sales' => 'Kreditsumme',
            'sale,Institute_SummaryPercent,&empty; Kreditsumme Sales' => '&empty; Kreditsumme',
            'sale,Institute_TimePercent,&empty; Laufzeit Sales' => '&empty; Laufzeit'
        );
        foreach ($options as $key => $value) {
            $typeSaleElement->addMultiOption($key, $value);
        }
        $typeSaleElement->setValue('sale,Institute_Click,Anzahl Sales');

        $this->addElements(
            array(
                $dateStartElement,
                //$startCalendarDiv,
                $dateEndElement,
                //$endCalendarDiv,
                $intervalElement,
                $partnerElement,
                $campaignElement,
                //$interfaceElement,
                //$beratungAntragElement,
                //$statusElement,
                $categoriesElement
            )
        );

        $this->addDisplayGroup(
            array('filterDateStart', 'filterDateEnd', 'groupValue'),
            'dates',
            array('legend' => 'Zeitraum')
        );
        $this->addDisplayGroup(array('portale'), 'gpartner', array('legend' => 'Partner'));
        $this->addDisplayGroup(array('campaigns'), 'gcampaign', array('legend' => 'Kampagne'));
        $this->addDisplayGroup(array('sparteValue'), 'gcategories', array('legend' => 'Category'));

        $this->addElements(
            array(
                $submitElement,
                $downloadElement,
                $typeClickoutElement,
                $typeClickoutSaleElement,
                $typeSaleElement
            )
        );

        $this->addDisplayGroup(array('clickouts'), 'gclickouts', array('legend' => 'Clickouts'));
        $this->addDisplayGroup(array('clickoutsales'), 'gclickoutsales', array('legend' => 'Clickouts (Internal)'));
        $this->addDisplayGroup(array('sales'), 'gsales', array('legend' => 'Sales'));

        //Form-Decorator zuweisen
        $this->setDecorators($this->formDecoratorsX);
    }
}