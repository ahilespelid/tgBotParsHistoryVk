<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

use 
    App\Models\FirstInstance,
    App\Models\FirstInstanceClaim,
    App\Models\FirstInstanceCurrentStateCase,
    App\Models\BankruptcyPaymentsMany,
    App\Models\FirstInstanceInformationProgress,
    App\Models\FirstInstanceStateDuty,
    App\Models\FirstInstanceStrategy,
    App\Models\FirstInstanceClaimPrice,
    App\Models\FirstInstanceClaimPriceMany,
    App\Models\FirstInstanceClaimMany,
    App\Models\FirstInstanceCurrentStateCaseMany,
    App\Models\BankruptcyPayments,
    App\Models\FirstInstanceInformationProgressMany,
    App\Models\FirstInstanceStateDutyMany,
    App\Models\FirstInstanceStrategyMany,
    App\Models\CourtsAppeal,
    App\Models\CourtsAppealStrategy,
    App\Models\MediationStrategy,
    App\Models\FirstInstanceDateUpcomingCase,
    App\Models\FirstInstanceDateUpcomingCaseMany,
    App\Models\CourtsAppealDateUpcomingCase,
    App\Models\CourtsAppealInformationProgress,
    App\Models\CourtsAppealStrategyMany,
    App\Models\CourtsAppealDateUpcomingCaseMany,
    App\Models\CourtsAppealInformationProgressMany,
    App\Models\CourtsResumption,
    App\Models\CourtsСassation,
    App\Models\EnforcementProceedingsStrategyMany,
    App\Models\EnforcementProceedingsInformationProgressMany,
    App\Models\EnforcementProceedingsInformationAuctionMany,
    App\Models\EnforcementProceedingsDateVisitBailiffMany,
    App\Models\BankruptcyStrategy,
    App\Models\BankruptcyStage,
    App\Models\BankruptcyStageMany,
    App\Models\BankruptcyInformationCourtMany,
    App\Models\CourtsCassationStrategy,
    App\Models\CourtsCassationStrategyMany,
    App\Models\CourtsCassationDateUpcomingCase,
    App\Models\CourtsCassationDateUpcomingCaseMany,
    App\Models\CourtsCassationInformationProgress,
    App\Models\CourtsCassationInformationProgressMany,
    App\Models\EnforcementProceedings,
    App\Models\EnforcementProceedingsStrategy,
    App\Models\EnforcementProceedingsInformationProgress,
    App\Models\EnforcementProceedingsInformationAuction,
    App\Models\EnforcementProceedingsDateVisitBailiff,
    App\Models\Bankruptcy,
    App\Models\BankruptcyStrategyMany,
    App\Models\BankruptcyInformationCourt,
    App\Models\Mediation,
    App\Models\MediationStrategyMany,
    App\Models\MediationTypeDebt,
    App\Models\MediationDiscountCalculation,
    App\Models\MediationDiscountCalculationMany,
    App\Models\MediationSecondOfferDebtor,
    App\Models\MediationSecondOfferDebtorMany,
    App\Models\CourtsResumptionStrategy,
    App\Models\CourtsResumptionStrategyMany;


class Controller extends BaseController{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    
///*/ Взять дело суда первой инстанции по ид ///*/
public function getFirstInstance(int $id):?array{
    if(empty($id)){return null;}
    
    if(!empty($data = FirstInstance::where('id', '=', $id)->first())){
        $data = $data->toArray();
        ///*/ Стратегия ///*/    
        if(empty($_id = FirstInstanceStrategyMany::where('deleted_at', '=', NULL)
                                                 ->where('first_instance_id', '=', $id)
                                                 ->orderBy('strategy_id', 'desc')
                                                 ->first())){
        $data['strategy'] = '';
        }elseif(!empty($_ob = FirstInstanceStrategy::where('deleted_at', '=', NULL)
                                                 ->where('id', '=', $_id->strategy_id)
                                                 ->first()->toArray())){
        $data['strategy'] = json_encode($_ob);
        }
        ///*/ Претензия ///*/
        if(empty($_id = FirstInstanceClaimMany::where('deleted_at', '=', NULL)
                                                 ->where('first_instance_id', '=', $id)
                                                 ->orderBy('claim_id', 'desc')
                                                 ->first())){
        $data['claim'] = '';
        }elseif(!empty($_ob = FirstInstanceClaim::where('deleted_at', '=', NULL)
                                                 ->where('id', '=', $_id->claim_id)
                                                 ->first()->toArray())){
        $data['claim'] = json_encode($_ob);
        }
        ///*/ Цена иска ///*/
        if(empty($_id = FirstInstanceClaimPriceMany::where('deleted_at', '=', NULL)
                                                 ->where('first_instance_id', '=', $id)
                                                 ->orderBy('claim_price_id', 'desc')
                                                 ->first())){
        $data['claim_price'] = '';
        }elseif(!empty($_ob = FirstInstanceClaimPrice::where('deleted_at', '=', NULL)
                                                 ->where('id', '=', $_id->claim_price_id)
                                                 ->first()->toArray())){
        $data['claim_price'] = json_encode($_ob);
        }
        ///*/ Госпошлина ///*/
        if(empty($_id = FirstInstanceStateDutyMany::where('deleted_at', '=', NULL)
                                                 ->where('first_instance_id', '=', $id)
                                                 ->orderBy('state_duty_id', 'desc')
                                                 ->first())){
        $data['state_duty'] = '';
        }elseif(!empty($_ob = FirstInstanceStateDuty::where('deleted_at', '=', NULL)
                                                 ->where('id', '=', $_id->state_duty_id)
                                                 ->first()->toArray())){
        $data['state_duty'] = json_encode($_ob);
        }
        ///*/ Информация о ходе дела ///*/
        if(empty($_id = FirstInstanceInformationProgressMany::where('deleted_at', '=', NULL)
                                                 ->where('first_instance_id', '=', $id)
                                                 ->orderBy('information_progress_id', 'desc')
                                                 ->first())){
        $data['information_progress'] = '';
        }elseif(!empty($_ob = FirstInstanceInformationProgress::where('deleted_at', '=', NULL)
                                                 ->where('id', '=', $_id->information_progress_id)
                                                 ->first()->toArray())){
        $data['information_progress'] = json_encode($_ob);
        }
        ///*/ Дата предстоящего судебного заседания ///*/
        if(empty($_id = FirstInstanceDateUpcomingCaseMany::where('deleted_at', '=', NULL)
                                                 ->where('first_instance_id', '=', $id)
                                                 ->orderBy('date_upcoming_case_id', 'desc')
                                                 ->first())){
        $data['date_upcoming_case'] = '';
        }elseif(!empty($_ob = FirstInstanceDateUpcomingCase::where('deleted_at', '=', NULL)
                                                 ->where('id', '=', $_id->date_upcoming_case_id)
                                                 ->first()->toArray())){
        $data['date_upcoming_case'] = json_encode($_ob);
        }
        ///*/ Текущее состояние дела ///*/
        if(empty($_id = FirstInstanceCurrentStateCaseMany::where('deleted_at', '=', NULL)
                                                 ->where('first_instance_id', '=', $id)
                                                 ->orderBy('current_state_case_id', 'desc')
                                                 ->first())){
        $data['current_state_case'] = '';
        }elseif(!empty($_ob = FirstInstanceCurrentStateCase::where('deleted_at', '=', NULL)
                                                 ->where('id', '=', $_id->current_state_case_id)
                                                 ->first()->toArray())){
        $data['current_state_case'] = json_encode($_ob);
    }}
return (!empty($ret = $this->mergeLabel($data, 'first_instance'))) ? $ret : '111';}
///*/ Взять дело суда апеляции по ид ///*/
public function getCourtsAppeal(int $id):?array{
    if(empty($id)){return null;}
    
    if(!empty($data = CourtsAppeal::where('id', '=', $id)->first())){
        $data = $data->toArray();
        ///*/ Стратегия ///*/    
        if(empty($_id = CourtsAppealStrategyMany::where('deleted_at', '=', NULL)
                                                 ->where('courts_appeal_id', '=', $id)
                                                 ->orderBy('strategy_id', 'desc')
                                                 ->first())){
        $data['strategy'] = '';
        }elseif(!empty($_ob = CourtsAppealStrategy::where('deleted_at', '=', NULL)
                                                 ->where('id', '=', $_id->strategy_id)
                                                 ->first()->toArray())){
        $data['strategy'] = json_encode($_ob);
        }
        ///*/ Дата назначения к слушанию ///*/
        if(empty($_id = CourtsAppealDateUpcomingCaseMany::where('deleted_at', '=', NULL)
                                                 ->where('courts_appeal_id', '=', $id)
                                                 ->orderBy('date_upcoming_case_id', 'desc')
                                                 ->first())){
        $data['date_upcoming_case'] = '';
        }elseif(!empty($_ob = CourtsAppealDateUpcomingCase::where('deleted_at', '=', NULL)
                                                 ->where('id', '=', $_id->date_upcoming_case_id)
                                                 ->first()->toArray())){
        $data['date_upcoming_case'] = json_encode($_ob);
        }
        ///*/ Информация о ходе дела ///*/
        if(empty($_id = CourtsAppealInformationProgressMany::where('deleted_at', '=', NULL)
                                                 ->where('courts_appeal_id', '=', $id)
                                                 ->orderBy('information_progress_id', 'desc')
                                                 ->first())){
        $data['information_progress'] = '';
        }elseif(!empty($_ob = CourtsAppealInformationProgress::where('deleted_at', '=', NULL)
                                                 ->where('id', '=', $_id->information_progress_id)
                                                 ->first()->toArray())){
        $data['information_progress'] = json_encode($_ob);
        }}
return (!empty($ret = $this->mergeLabel($data, 'courts_appeal'))) ? $ret : null;}
///*/ Взять дело суда касации по ид ///*/
public function getCourtsСassation(int $id):?array{
    if(empty($id)){return null;}
    
    if(!empty($data = CourtsСassation::where('id', '=', $id)->first())){
        $data = $data->toArray();
        ///*/ Стратегия ///*/    
        if(empty($_id = CourtsCassationStrategyMany::where('deleted_at', '=', NULL)
                                                 ->where('courts_сassation_id', '=', $id)
                                                 ->orderBy('strategy_id', 'desc')
                                                 ->first())){
        $data['strategy'] = '';
        }elseif(!empty($_ob = CourtsCassationStrategy::where('deleted_at', '=', NULL)
                                                 ->where('id', '=', $_id->strategy_id)
                                                 ->first()->toArray())){
        $data['strategy'] = json_encode($_ob);
        }
        ///*/ Дата назначения к слушанию ///*/
        if(empty($_id = CourtsCassationDateUpcomingCaseMany::where('deleted_at', '=', NULL)
                                                 ->where('courts_сassation_id', '=', $id)
                                                 ->orderBy('date_upcoming_case_id', 'desc')
                                                 ->first())){
        $data['date_upcoming_case'] = '';
        }elseif(!empty($_ob = CourtsCassationDateUpcomingCase::where('deleted_at', '=', NULL)
                                                 ->where('id', '=', $_id->date_upcoming_case_id)
                                                 ->first()->toArray())){
        $data['date_upcoming_case'] = json_encode($_ob);
        }
        ///*/ Информация о ходе дела ///*/
        if(empty($_id = CourtsCassationInformationProgressMany::where('deleted_at', '=', NULL)
                                                 ->where('courts_сassation_id', '=', $id)
                                                 ->orderBy('information_progress_id', 'desc')
                                                 ->first())){
        $data['information_progress'] = '';
        }elseif(!empty($_ob = CourtsCassationInformationProgress::where('deleted_at', '=', NULL)
                                                 ->where('id', '=', $_id->information_progress_id)
                                                 ->first()->toArray())){
        $data['information_progress'] = json_encode($_ob);
        }}
return (!empty($ret = $this->mergeLabel($data, 'courts_cassation'))) ? $ret : null;}
///*/ Взять дело исполнительного производства по ид ///*/
public function getEnforcementProceedings(int $id):?array{
    if(empty($id)){return null;}
    
    if(!empty($data = EnforcementProceedings::where('id', '=', $id)->first())){
        $data = $data->toArray();
        ///*/ Стратегия ///*/    
        if(empty($_id = EnforcementProceedingsStrategyMany::where('deleted_at', '=', NULL)
                                                 ->where('enforcement_proceedings_id', '=', $id)
                                                 ->orderBy('strategy_id', 'desc')
                                                 ->first())){
        $data['strategy'] = '';
        }elseif(!empty($_ob = EnforcementProceedingsStrategy::where('deleted_at', '=', NULL)
                                                 ->where('id', '=', $_id->strategy_id)
                                                 ->first()->toArray())){
        $data['strategy'] = json_encode($_ob);
        }
        ///*/ Информация о ходе исполнительного производства ///*/
        if(empty($_id = EnforcementProceedingsInformationProgressMany::where('deleted_at', '=', NULL)
                                                 ->where('enforcement_proceedings_id', '=', $id)
                                                 ->orderBy('information_progress_id', 'desc')
                                                 ->first())){
        $data['information_progress'] = '';
        }elseif(!empty($_ob = EnforcementProceedingsInformationProgress::where('deleted_at', '=', NULL)
                                                 ->where('id', '=', $_id->information_progress_id)
                                                 ->first()->toArray())){
        $data['information_progress'] = json_encode($_ob);
        }
        ///*/ Даты посещения судебного пристава-исполнителя для контроля его действий и уточнения информации ///*/
        if(empty($_id = EnforcementProceedingsDateVisitBailiffMany::where('deleted_at', '=', NULL)
                                                 ->where('enforcement_proceedings_id', '=', $id)
                                                 ->orderBy('date_visit_bailiff_id', 'desc')
                                                 ->first())){
        $data['date_visit_bailiff'] = '';
        }elseif(!empty($_ob = EnforcementProceedingsDateVisitBailiff::where('deleted_at', '=', NULL)
                                                 ->where('id', '=', $_id->date_visit_bailiff_id)
                                                 ->first()->toArray())){
        $data['date_visit_bailiff'] = json_encode($_ob);
        }
        ///*/ Сведения о торгах, дата ///*/
        if(empty($_id = EnforcementProceedingsInformationAuctionMany::where('deleted_at', '=', NULL)
                                                 ->where('enforcement_proceedings_id', '=', $id)
                                                 ->orderBy('information_auction_id', 'desc')
                                                 ->first())){
        $data['information_auction'] = '';
        }elseif(!empty($_ob = EnforcementProceedingsInformationAuction::where('deleted_at', '=', NULL)
                                                 ->where('id', '=', $_id->information_auction_id)
                                                 ->first()->toArray())){
        $data['information_auction'] = json_encode($_ob);
        }}
        //pa($data); exit;
return (!empty($ret = $this->mergeLabel($data, 'enforcement_proceedings'))) ? $ret : null;}
///*/ Взять дело банкротсва по ид ///*/
public function getBankruptcy(int $id):?array{
    if(empty($id)){return null;}
    
    if(!empty($data = Bankruptcy::where('id', '=', $id)->first())){
        $data = $data->toArray();
        ///*/ Стратегия ///*/    
        if(empty($_id = BankruptcyStrategyMany::where('deleted_at', '=', NULL)
                                                 ->where('bankruptcy_id', '=', $id)
                                                 ->orderBy('strategy_id', 'desc')
                                                 ->first())){
        $data['strategy'] = '';
        }elseif(!empty($_ob = BankruptcyStrategy::where('deleted_at', '=', NULL)
                                                 ->where('id', '=', $_id->strategy_id)
                                                 ->first()->toArray())){
        $data['strategy'] = json_encode($_ob);
        }
        ///*/ Стадия банкротства ///*/
        if(empty($_id = BankruptcyStageMany::where('deleted_at', '=', NULL)
                                                 ->where('bankruptcy_id', '=', $id)
                                                 ->orderBy('stage_id', 'desc')
                                                 ->first())){
        $data['stage'] = '';
        }elseif(!empty($_ob = BankruptcyStage::where('deleted_at', '=', NULL)
                                                 ->where('id', '=', $_id->stage_id)
                                                 ->first()->toArray())){
        $data['stage'] = json_encode($_ob);
        }
        ///*/ Информация об участии финансового управляющего на судебных заседаниях ///*/
        if(empty($_id = BankruptcyInformationCourtMany::where('deleted_at', '=', NULL)
                                                 ->where('bankruptcy_id', '=', $id)
                                                 ->orderBy('information_court_id', 'desc')
                                                 ->first())){
        $data['information_court'] = '';
        }elseif(!empty($_ob = BankruptcyInformationCourt::where('deleted_at', '=', NULL)
                                                 ->where('id', '=', $_id->information_court_id)
                                                 ->first()->toArray())){
        $data['information_court'] = json_encode($_ob);
        }
        ///*/ Платежи, сумма оплат, п/п ///*/
        if(empty($_id = BankruptcyPaymentsMany::where('deleted_at', '=', NULL)
                                                 ->where('bankruptcy_id', '=', $id)
                                                 ->orderBy('payments_id', 'desc')
                                                 ->first())){
        $data['payments'] = '';
        }elseif(!empty($_ob = BankruptcyPayments::where('deleted_at', '=', NULL)
                                                 ->where('id', '=', $_id->payments_id)
                                                 ->first()->toArray())){
        $data['payments'] = json_encode($_ob);
        }}
        //pa($data); exit;
return (!empty($ret = $this->mergeLabel($data, 'bankruptcy'))) ? $ret : null;}
///*/ Взять дело медиации по ид ///*/
public function getMediation(int $id):?array{
    if(empty($id)){return null;}
    
    if(!empty($data = Mediation::where('id', '=', $id)->first())){
        $data = $data->toArray();
        ///*/ Стратегия ///*/    
        if(empty($_id = MediationStrategyMany::where('deleted_at', '=', NULL)
                                                 ->where('mediation_id', '=', $id)
                                                 ->orderBy('strategy_id', 'desc')
                                                 ->first())){
        $data['strategy'] = '';
        }elseif(!empty($_ob = MediationStrategy::where('deleted_at', '=', NULL)
                                                 ->where('id', '=', $_id->strategy_id)
                                                 ->first()->toArray())){
        $data['strategy'] = json_encode($_ob);
        }
        ///*/ Определение типа долга ///*/
        if(!empty($_ob = MediationTypeDebt::where('deleted_at', '=', NULL)->get())){
        $type_debt = (!empty($data['type_debt'])) ? $data['type_debt'] : 1; unset($data['type_debt']);
       
        $data['type_debt']['data'] = json_encode($_ob->toArray());
        $data['type_debt']['selected'] = $type_debt;
        }
        ///*/ Расчет дисконта ///*/
        if(empty($_id = MediationDiscountCalculationMany::where('deleted_at', '=', NULL)
                                                 ->where('mediation_id', '=', $id)
                                                 ->orderBy('discount_calculation_id', 'desc')
                                                 ->first())){
        $data['discount_calculation'] = '';
        }elseif(!empty($_ob = MediationDiscountCalculation::where('deleted_at', '=', NULL)
                                                 ->where('id', '=', $_id->discount_calculation_id)
                                                 ->first()->toArray())){
        $data['discount_calculation'] = json_encode($_ob);
        }
        ///*/ Второе предложение должнику ///*/
        if(empty($_id = MediationSecondOfferDebtorMany::where('deleted_at', '=', NULL)
                                                 ->where('mediation_id', '=', $id)
                                                 ->orderBy('second_offer_debtor_id', 'desc')
                                                 ->first())){
        $data['second_offer_debtor'] = '';
        }elseif(!empty($_ob = MediationSecondOfferDebtor::where('deleted_at', '=', NULL)
                                                 ->where('id', '=', $_id->second_offer_debtor_id)
                                                 ->first()->toArray())){
        $data['second_offer_debtor'] = json_encode($_ob);
        }}
        //pa($data); exit;
return (!empty($ret = $this->mergeLabel($data, 'mediation'))) ? $ret : null;}
///*/ Взять дело возобновление производства по ид ///*/
public function getCourtsResumption(int $id):?array{
    if(empty($id)){return null;}
    
    if(!empty($data = CourtsResumption::where('id', '=', $id)->first())){
        $data = $data->toArray();
        ///*/ Стратегия ///*/    
        if(empty($_id = CourtsResumptionStrategyMany::where('deleted_at', '=', NULL)
                                                 ->where('courts_resumption_id', '=', $id)
                                                 ->orderBy('strategy_id', 'desc')
                                                 ->first())){
        $data['strategy'] = '';
        }elseif(!empty($_ob = CourtsResumptionStrategy::where('deleted_at', '=', NULL)
                                                 ->where('id', '=', $_id->strategy_id)
                                                 ->first()->toArray())){
        $data['strategy'] = json_encode($_ob);
        }}
return (!empty($ret = $this->mergeLabel($data, 'courts_resumption'))) ? $ret : null;}


///*/ Обьединить наименования полей ввода из resource/arrays с данными из базы ///*/
public function mergeLabel(array $data, string $nameResoursArrayLable):?array{
    if(empty($nameResoursArrayLable)){return null;} 
    
    if(!empty($lable = $this->getLabels($nameResoursArrayLable))){
        foreach($lable as $key => $val){
            $ret[$key] = $val + ['data' => $data[$key]]; unset($data[$key]);
        }$ret += $data;
    }
return (!empty($ret) && is_array($ret)) ? $ret : null;}
///*/ Взять наименования полей ввода ///*/
public function getLabels(string $instance):?array{
    if(empty($instance)){return null;}
    
    if(file_exists($path = resource_path('arrays'.DIRECTORY_SEPARATOR .$instance.'.php'))){
        $fields = include $path;
        return !empty($fields) ? $fields : null;}
return null;} 

}