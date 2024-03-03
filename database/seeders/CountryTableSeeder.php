<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CountryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('country')->truncate();
    	
        DB::table('country')->insert([

        ['short_name' => 'AF','name' => 'Afghanistan','iso3' => 'AFG','number_code' => '4','phone_code' => '93'],
  		['short_name' => 'AL','name' => 'Albania','iso3' => 'ALB','number_code' => '8','phone_code' => '355'],
  		['short_name' => 'DZ','name' => 'Algeria','iso3' => 'DZA','number_code' => '12','phone_code' => '213'],
  		['short_name' => 'AS','name' => 'American Samoa','iso3' => 'ASM','number_code' => '16','phone_code' => '1684'],
  		['short_name' => 'AD','name' => 'Andorra','iso3' => 'AND','number_code' => '20','phone_code' => '376'],
  		['short_name' => 'AO','name' => 'Angola','iso3' => 'AGO','number_code' => '24','phone_code' => '244'],
  		['short_name' => 'AI','name' => 'Anguilla','iso3' => 'AIA','number_code' => '660','phone_code' => '1264'],
  		['short_name' => 'AQ','name' => 'Antarctica','iso3' => NULL,'number_code' => NULL,'phone_code' => '0'],
  		['short_name' => 'AG','name' => 'Antigua and Barbuda','iso3' => 'ATG','number_code' => '28','phone_code' => '1268'],
  		['short_name' => 'AR','name' => 'Argentina','iso3' => 'ARG','number_code' => '32','phone_code' => '54'],
  		['short_name' => 'AM','name' => 'Armenia','iso3' => 'ARM','number_code' => '51','phone_code' => '374'],
  		['short_name' => 'AW','name' => 'Aruba','iso3' => 'ABW','number_code' => '533','phone_code' => '297'],
  		['short_name' => 'AU','name' => 'Australia','iso3' => 'AUS','number_code' => '36','phone_code' => '61'],
  		['short_name' => 'AT','name' => 'Austria','iso3' => 'AUT','number_code' => '40','phone_code' => '43'],
  		['short_name' => 'AZ','name' => 'Azerbaijan','iso3' => 'AZE','number_code' => '31','phone_code' => '994'],
  		['short_name' => 'BS','name' => 'Bahamas','iso3' => 'BHS','number_code' => '44','phone_code' => '1242'],
  		['short_name' => 'BH','name' => 'Bahrain','iso3' => 'BHR','number_code' => '48','phone_code' => '973'],
  		['short_name' => 'BD','name' => 'Bangladesh','iso3' => 'BGD','number_code' => '50','phone_code' => '880'],
  		['short_name' => 'BB','name' => 'Barbados','iso3' => 'BRB','number_code' => '52','phone_code' => '1246'],
  		['short_name' => 'BY','name' => 'Belarus','iso3' => 'BLR','number_code' => '112','phone_code' => '375'],
  		['short_name' => 'BE','name' => 'Belgium','iso3' => 'BEL','number_code' => '56','phone_code' => '32'],
  		['short_name' => 'BZ','name' => 'Belize','iso3' => 'BLZ','number_code' => '84','phone_code' => '501'],
  		['short_name' => 'BJ','name' => 'Benin','iso3' => 'BEN','number_code' => '204','phone_code' => '229'],
  		['short_name' => 'BM','name' => 'Bermuda','iso3' => 'BMU','number_code' => '60','phone_code' => '1441'],
  		['short_name' => 'BT','name' => 'Bhutan','iso3' => 'BTN','number_code' => '64','phone_code' => '975'],
  		['short_name' => 'BO','name' => 'Bolivia','iso3' => 'BOL','number_code' => '68','phone_code' => '591'],
  		['short_name' => 'BA','name' => 'Bosnia and Herzegovina','iso3' => 'BIH','number_code' => '70','phone_code' => '387'],
  		['short_name' => 'BW','name' => 'Botswana','iso3' => 'BWA','number_code' => '72','phone_code' => '267'],
  		['short_name' => 'BV','name' => 'Bouvet Island','iso3' => NULL,'number_code' => NULL,'phone_code' => '0'],
  		['short_name' => 'BR','name' => 'Brazil','iso3' => 'BRA','number_code' => '76','phone_code' => '55'],
  		['short_name' => 'IO','name' => 'British Indian Ocean Territory','iso3' => NULL,'number_code' => NULL,'phone_code' => '246'],
  		['short_name' => 'BN','name' => 'Brunei Darussalam','iso3' => 'BRN','number_code' => '96','phone_code' => '673'],
  		['short_name' => 'BG','name' => 'Bulgaria','iso3' => 'BGR','number_code' => '100','phone_code' => '359'],
  		['short_name' => 'BF','name' => 'Burkina Faso','iso3' => 'BFA','number_code' => '854','phone_code' => '226'],
  		['short_name' => 'BI','name' => 'Burundi','iso3' => 'BDI','number_code' => '108','phone_code' => '257'],
  		['short_name' => 'KH','name' => 'Cambodia','iso3' => 'KHM','number_code' => '116','phone_code' => '855'],
  		['short_name' => 'CM','name' => 'Cameroon','iso3' => 'CMR','number_code' => '120','phone_code' => '237'],
  		['short_name' => 'CA','name' => 'Canada','iso3' => 'CAN','number_code' => '124','phone_code' => '1'],
  		['short_name' => 'CV','name' => 'Cape Verde','iso3' => 'CPV','number_code' => '132','phone_code' => '238'],
  		['short_name' => 'KY','name' => 'Cayman Islands','iso3' => 'CYM','number_code' => '136','phone_code' => '1345'],
  		['short_name' => 'CF','name' => 'Central African Republic','iso3' => 'CAF','number_code' => '140','phone_code' => '236'],
  		['short_name' => 'TD','name' => 'Chad','iso3' => 'TCD','number_code' => '148','phone_code' => '235'],
  		['short_name' => 'CL','name' => 'Chile','iso3' => 'CHL','number_code' => '152','phone_code' => '56'],
  		['short_name' => 'CN','name' => 'China','iso3' => 'CHN','number_code' => '156','phone_code' => '86'],
  		['short_name' => 'CX','name' => 'Christmas Island','iso3' => NULL,'number_code' => NULL,'phone_code' => '61'],
  		['short_name' => 'CC','name' => 'Cocos (Keeling) Islands','iso3' => NULL,'number_code' => NULL,'phone_code' => '672'],
  		['short_name' => 'CO','name' => 'Colombia','iso3' => 'COL','number_code' => '170','phone_code' => '57'],
  		['short_name' => 'KM','name' => 'Comoros','iso3' => 'COM','number_code' => '174','phone_code' => '269'],
  		['short_name' => 'CG','name' => 'Congo','iso3' => 'COG','number_code' => '178','phone_code' => '242'],
  		['short_name' => 'CD','name' => 'Congo, the Democratic Republic of the','iso3' => 'COD','number_code' => '180','phone_code' => '242'],
  		['short_name' => 'CK','name' => 'Cook Islands','iso3' => 'COK','number_code' => '184','phone_code' => '682'],
  		['short_name' => 'CR','name' => 'Costa Rica','iso3' => 'CRI','number_code' => '188','phone_code' => '506'],
  		['short_name' => 'CI','name' => 'Cote D\'Ivoire','iso3' => 'CIV','number_code' => '384','phone_code' => '225'],
  		['short_name' => 'HR','name' => 'Croatia','iso3' => 'HRV','number_code' => '191','phone_code' => '385'],
  		['short_name' => 'CU','name' => 'Cuba','iso3' => 'CUB','number_code' => '192','phone_code' => '53'],
  		['short_name' => 'CY','name' => 'Cyprus','iso3' => 'CYP','number_code' => '196','phone_code' => '357'],
  		['short_name' => 'CZ','name' => 'Czech Republic','iso3' => 'CZE','number_code' => '203','phone_code' => '420'],
  		['short_name' => 'DK','name' => 'Denmark','iso3' => 'DNK','number_code' => '208','phone_code' => '45'],
  		['short_name' => 'DJ','name' => 'Djibouti','iso3' => 'DJI','number_code' => '262','phone_code' => '253'],
  		['short_name' => 'DM','name' => 'Dominica','iso3' => 'DMA','number_code' => '212','phone_code' => '1767'],
  		['short_name' => 'DO','name' => 'Dominican Republic','iso3' => 'DOM','number_code' => '214','phone_code' => '1809'],
  		['short_name' => 'EC','name' => 'Ecuador','iso3' => 'ECU','number_code' => '218','phone_code' => '593'],
  		['short_name' => 'EG','name' => 'Egypt','iso3' => 'EGY','number_code' => '818','phone_code' => '20'],
  		['short_name' => 'SV','name' => 'El Salvador','iso3' => 'SLV','number_code' => '222','phone_code' => '503'],
  		['short_name' => 'GQ','name' => 'Equatorial Guinea','iso3' => 'GNQ','number_code' => '226','phone_code' => '240'],
  		['short_name' => 'ER','name' => 'Eritrea','iso3' => 'ERI','number_code' => '232','phone_code' => '291'],
  		['short_name' => 'EE','name' => 'Estonia','iso3' => 'EST','number_code' => '233','phone_code' => '372'],
  		['short_name' => 'ET','name' => 'Ethiopia','iso3' => 'ETH','number_code' => '231','phone_code' => '251'],
  		['short_name' => 'FK','name' => 'Falkland Islands (Malvinas)','iso3' => 'FLK','number_code' => '238','phone_code' => '500'],
  		['short_name' => 'FO','name' => 'Faroe Islands','iso3' => 'FRO','number_code' => '234','phone_code' => '298'],
  		['short_name' => 'FJ','name' => 'Fiji','iso3' => 'FJI','number_code' => '242','phone_code' => '679'],
  		['short_name' => 'FI','name' => 'Finland','iso3' => 'FIN','number_code' => '246','phone_code' => '358'],
  		['short_name' => 'FR','name' => 'France','iso3' => 'FRA','number_code' => '250','phone_code' => '33'],
  		['short_name' => 'GF','name' => 'French Guiana','iso3' => 'GUF','number_code' => '254','phone_code' => '594'],
  		['short_name' => 'PF','name' => 'French Polynesia','iso3' => 'PYF','number_code' => '258','phone_code' => '689'],
  		['short_name' => 'TF','name' => 'French Southern Territories','iso3' => NULL,'number_code' => NULL,'phone_code' => '0'],
  		['short_name' => 'GA','name' => 'Gabon','iso3' => 'GAB','number_code' => '266','phone_code' => '241'],
  		['short_name' => 'GM','name' => 'Gambia','iso3' => 'GMB','number_code' => '270','phone_code' => '220'],
  		['short_name' => 'GE','name' => 'Georgia','iso3' => 'GEO','number_code' => '268','phone_code' => '995'],
  		['short_name' => 'DE','name' => 'Germany','iso3' => 'DEU','number_code' => '276','phone_code' => '49'],
  		['short_name' => 'GH','name' => 'Ghana','iso3' => 'GHA','number_code' => '288','phone_code' => '233'],
  		['short_name' => 'GI','name' => 'Gibraltar','iso3' => 'GIB','number_code' => '292','phone_code' => '350'],
  		['short_name' => 'GR','name' => 'Greece','iso3' => 'GRC','number_code' => '300','phone_code' => '30'],
  		['short_name' => 'GL','name' => 'Greenland','iso3' => 'GRL','number_code' => '304','phone_code' => '299'],
  		['short_name' => 'GD','name' => 'Grenada','iso3' => 'GRD','number_code' => '308','phone_code' => '1473'],
  		['short_name' => 'GP','name' => 'Guadeloupe','iso3' => 'GLP','number_code' => '312','phone_code' => '590'],
  		['short_name' => 'GU','name' => 'Guam','iso3' => 'GUM','number_code' => '316','phone_code' => '1671'],
  		['short_name' => 'GT','name' => 'Guatemala','iso3' => 'GTM','number_code' => '320','phone_code' => '502'],
  		['short_name' => 'GN','name' => 'Guinea','iso3' => 'GIN','number_code' => '324','phone_code' => '224'],
  		['short_name' => 'GW','name' => 'Guinea-Bissau','iso3' => 'GNB','number_code' => '624','phone_code' => '245'],
  		['short_name' => 'GY','name' => 'Guyana','iso3' => 'GUY','number_code' => '328','phone_code' => '592'],
  		['short_name' => 'HT','name' => 'Haiti','iso3' => 'HTI','number_code' => '332','phone_code' => '509'],
  		['short_name' => 'HM','name' => 'Heard Island and Mcdonald Islands','iso3' => NULL,'number_code' => NULL,'phone_code' => '0'],
  		['short_name' => 'VA','name' => 'Holy See (Vatican City State)','iso3' => 'VAT','number_code' => '336','phone_code' => '39'],
  		['short_name' => 'HN','name' => 'Honduras','iso3' => 'HND','number_code' => '340','phone_code' => '504'],
  		['short_name' => 'HK','name' => 'Hong Kong','iso3' => 'HKG','number_code' => '344','phone_code' => '852'],
  		['short_name' => 'HU','name' => 'Hungary','iso3' => 'HUN','number_code' => '348','phone_code' => '36'],
  		['short_name' => 'IS','name' => 'Iceland','iso3' => 'ISL','number_code' => '352','phone_code' => '354'],
  		['short_name' => 'IN','name' => 'India','iso3' => 'IND','number_code' => '356','phone_code' => '91'],
  		['short_name' => 'ID','name' => 'Indonesia','iso3' => 'IDN','number_code' => '360','phone_code' => '62'],
  		['short_name' => 'IR','name' => 'Iran, Islamic Republic of','iso3' => 'IRN','number_code' => '364','phone_code' => '98'],
  		['short_name' => 'IQ','name' => 'Iraq','iso3' => 'IRQ','number_code' => '368','phone_code' => '964'],
  		['short_name' => 'IE','name' => 'Ireland','iso3' => 'IRL','number_code' => '372','phone_code' => '353'],
  		['short_name' => 'IL','name' => 'Israel','iso3' => 'ISR','number_code' => '376','phone_code' => '972'],
  		['short_name' => 'IT','name' => 'Italy','iso3' => 'ITA','number_code' => '380','phone_code' => '39'],
  		['short_name' => 'JM','name' => 'Jamaica','iso3' => 'JAM','number_code' => '388','phone_code' => '1876'],
  		['short_name' => 'JP','name' => 'Japan','iso3' => 'JPN','number_code' => '392','phone_code' => '81'],
  		['short_name' => 'JO','name' => 'Jordan','iso3' => 'JOR','number_code' => '400','phone_code' => '962'],
  		['short_name' => 'KZ','name' => 'Kazakhstan','iso3' => 'KAZ','number_code' => '398','phone_code' => '7'],
  		['short_name' => 'KE','name' => 'Kenya','iso3' => 'KEN','number_code' => '404','phone_code' => '254'],
  		['short_name' => 'KI','name' => 'Kiribati','iso3' => 'KIR','number_code' => '296','phone_code' => '686'],
  		['short_name' => 'KP','name' => 'Korea, Democratic People\'s Republic of','iso3' => 'PRK','number_code' => '408','phone_code' => '850'],
  		['short_name' => 'KR','name' => 'Korea, Republic of','iso3' => 'KOR','number_code' => '410','phone_code' => '82'],
  		['short_name' => 'KW','name' => 'Kuwait','iso3' => 'KWT','number_code' => '414','phone_code' => '965'],
  		['short_name' => 'KG','name' => 'Kyrgyzstan','iso3' => 'KGZ','number_code' => '417','phone_code' => '996'],
  		['short_name' => 'LA','name' => 'Lao People\'s Democratic Republic','iso3' => 'LAO','number_code' => '418','phone_code' => '856'],
  		['short_name' => 'LV','name' => 'Latvia','iso3' => 'LVA','number_code' => '428','phone_code' => '371'],
  		['short_name' => 'LB','name' => 'Lebanon','iso3' => 'LBN','number_code' => '422','phone_code' => '961'],
  		['short_name' => 'LS','name' => 'Lesotho','iso3' => 'LSO','number_code' => '426','phone_code' => '266'],
  		['short_name' => 'LR','name' => 'Liberia','iso3' => 'LBR','number_code' => '430','phone_code' => '231'],
  		['short_name' => 'LY','name' => 'Libyan Arab Jamahiriya','iso3' => 'LBY','number_code' => '434','phone_code' => '218'],
  		['short_name' => 'LI','name' => 'Liechtenstein','iso3' => 'LIE','number_code' => '438','phone_code' => '423'],
  		['short_name' => 'LT','name' => 'Lithuania','iso3' => 'LTU','number_code' => '440','phone_code' => '370'],
  		['short_name' => 'LU','name' => 'Luxembourg','iso3' => 'LUX','number_code' => '442','phone_code' => '352'],
  		['short_name' => 'MO','name' => 'Macao','iso3' => 'MAC','number_code' => '446','phone_code' => '853'],
  		['short_name' => 'MK','name' => 'Macedonia, the Former Yugoslav Republic of','iso3' => 'MKD','number_code' => '807','phone_code' => '389'],
  		['short_name' => 'MG','name' => 'Madagascar','iso3' => 'MDG','number_code' => '450','phone_code' => '261'],
  		['short_name' => 'MW','name' => 'Malawi','iso3' => 'MWI','number_code' => '454','phone_code' => '265'],
  		['short_name' => 'MY','name' => 'Malaysia','iso3' => 'MYS','number_code' => '458','phone_code' => '60'],
  		['short_name' => 'MV','name' => 'Maldives','iso3' => 'MDV','number_code' => '462','phone_code' => '960'],
  		['short_name' => 'ML','name' => 'Mali','iso3' => 'MLI','number_code' => '466','phone_code' => '223'],
  		['short_name' => 'MT','name' => 'Malta','iso3' => 'MLT','number_code' => '470','phone_code' => '356'],
  		['short_name' => 'MH','name' => 'Marshall Islands','iso3' => 'MHL','number_code' => '584','phone_code' => '692'],
  		['short_name' => 'MQ','name' => 'Martinique','iso3' => 'MTQ','number_code' => '474','phone_code' => '596'],
  		['short_name' => 'MR','name' => 'Mauritania','iso3' => 'MRT','number_code' => '478','phone_code' => '222'],
  		['short_name' => 'MU','name' => 'Mauritius','iso3' => 'MUS','number_code' => '480','phone_code' => '230'],
  		['short_name' => 'YT','name' => 'Mayotte','iso3' => NULL,'number_code' => NULL,'phone_code' => '269'],
  		['short_name' => 'MX','name' => 'Mexico','iso3' => 'MEX','number_code' => '484','phone_code' => '52'],
  		['short_name' => 'FM','name' => 'Micronesia, Federated States of','iso3' => 'FSM','number_code' => '583','phone_code' => '691'],
  		['short_name' => 'MD','name' => 'Moldova, Republic of','iso3' => 'MDA','number_code' => '498','phone_code' => '373'],
  		['short_name' => 'MC','name' => 'Monaco','iso3' => 'MCO','number_code' => '492','phone_code' => '377'],
  		['short_name' => 'MN','name' => 'Mongolia','iso3' => 'MNG','number_code' => '496','phone_code' => '976'],
  		['short_name' => 'MS','name' => 'Montserrat','iso3' => 'MSR','number_code' => '500','phone_code' => '1664'],
  		['short_name' => 'MA','name' => 'Morocco','iso3' => 'MAR','number_code' => '504','phone_code' => '212'],
  		['short_name' => 'MZ','name' => 'Mozambique','iso3' => 'MOZ','number_code' => '508','phone_code' => '258'],
  		['short_name' => 'MM','name' => 'Myanmar','iso3' => 'MMR','number_code' => '104','phone_code' => '95'],
  		['short_name' => 'NA','name' => 'Namibia','iso3' => 'NAM','number_code' => '516','phone_code' => '264'],
  		['short_name' => 'NR','name' => 'Nauru','iso3' => 'NRU','number_code' => '520','phone_code' => '674'],
  		['short_name' => 'NP','name' => 'Nepal','iso3' => 'NPL','number_code' => '524','phone_code' => '977'],
  		['short_name' => 'NL','name' => 'Netherlands','iso3' => 'NLD','number_code' => '528','phone_code' => '31'],
  		['short_name' => 'AN','name' => 'Netherlands Antilles','iso3' => 'ANT','number_code' => '530','phone_code' => '599'],
  		['short_name' => 'NC','name' => 'New Caledonia','iso3' => 'NCL','number_code' => '540','phone_code' => '687'],
  		['short_name' => 'NZ','name' => 'New Zealand','iso3' => 'NZL','number_code' => '554','phone_code' => '64'],
  		['short_name' => 'NI','name' => 'Nicaragua','iso3' => 'NIC','number_code' => '558','phone_code' => '505'],
  		['short_name' => 'NE','name' => 'Niger','iso3' => 'NER','number_code' => '562','phone_code' => '227'],
  		['short_name' => 'NG','name' => 'Nigeria','iso3' => 'NGA','number_code' => '566','phone_code' => '234'],
  		['short_name' => 'NU','name' => 'Niue','iso3' => 'NIU','number_code' => '570','phone_code' => '683'],
  		['short_name' => 'NF','name' => 'Norfolk Island','iso3' => 'NFK','number_code' => '574','phone_code' => '672'],
  		['short_name' => 'MP','name' => 'Northern Mariana Islands','iso3' => 'MNP','number_code' => '580','phone_code' => '1670'],
  		['short_name' => 'NO','name' => 'Norway','iso3' => 'NOR','number_code' => '578','phone_code' => '47'],
  		['short_name' => 'OM','name' => 'Oman','iso3' => 'OMN','number_code' => '512','phone_code' => '968'],
  		['short_name' => 'PK','name' => 'Pakistan','iso3' => 'PAK','number_code' => '586','phone_code' => '92'],
  		['short_name' => 'PW','name' => 'Palau','iso3' => 'PLW','number_code' => '585','phone_code' => '680'],
  		['short_name' => 'PS','name' => 'Palestinian Territory, Occupied','iso3' => NULL,'number_code' => NULL,'phone_code' => '970'],
  		['short_name' => 'PA','name' => 'Panama','iso3' => 'PAN','number_code' => '591','phone_code' => '507'],
  		['short_name' => 'PG','name' => 'Papua New Guinea','iso3' => 'PNG','number_code' => '598','phone_code' => '675'],
  		['short_name' => 'PY','name' => 'Paraguay','iso3' => 'PRY','number_code' => '600','phone_code' => '595'],
  		['short_name' => 'PE','name' => 'Peru','iso3' => 'PER','number_code' => '604','phone_code' => '51'],
  		['short_name' => 'PH','name' => 'Philippines','iso3' => 'PHL','number_code' => '608','phone_code' => '63'],
  		['short_name' => 'PN','name' => 'Pitcairn','iso3' => 'PCN','number_code' => '612','phone_code' => '0'],
  		['short_name' => 'PL','name' => 'Poland','iso3' => 'POL','number_code' => '616','phone_code' => '48'],
  		['short_name' => 'PT','name' => 'Portugal','iso3' => 'PRT','number_code' => '620','phone_code' => '351'],
  		['short_name' => 'PR','name' => 'Puerto Rico','iso3' => 'PRI','number_code' => '630','phone_code' => '1787'],
  		['short_name' => 'QA','name' => 'Qatar','iso3' => 'QAT','number_code' => '634','phone_code' => '974'],
  		['short_name' => 'RE','name' => 'Reunion','iso3' => 'REU','number_code' => '638','phone_code' => '262'],
  		['short_name' => 'RO','name' => 'Romania','iso3' => 'ROM','number_code' => '642','phone_code' => '40'],
  		['short_name' => 'RU','name' => 'Russian Federation','iso3' => 'RUS','number_code' => '643','phone_code' => '70'],
  		['short_name' => 'RW','name' => 'Rwanda','iso3' => 'RWA','number_code' => '646','phone_code' => '250'],
  		['short_name' => 'SH','name' => 'Saint Helena','iso3' => 'SHN','number_code' => '654','phone_code' => '290'],
  		['short_name' => 'KN','name' => 'Saint Kitts and Nevis','iso3' => 'KNA','number_code' => '659','phone_code' => '1869'],
  		['short_name' => 'LC','name' => 'Saint Lucia','iso3' => 'LCA','number_code' => '662','phone_code' => '1758'],
  		['short_name' => 'PM','name' => 'Saint Pierre and Miquelon','iso3' => 'SPM','number_code' => '666','phone_code' => '508'],
  		['short_name' => 'VC','name' => 'Saint Vincent and the Grenadines','iso3' => 'VCT','number_code' => '670','phone_code' => '1784'],
  		['short_name' => 'WS','name' => 'Samoa','iso3' => 'WSM','number_code' => '882','phone_code' => '684'],
  		['short_name' => 'SM','name' => 'San Marino','iso3' => 'SMR','number_code' => '674','phone_code' => '378'],
  		['short_name' => 'ST','name' => 'Sao Tome and Principe','iso3' => 'STP','number_code' => '678','phone_code' => '239'],
  		['short_name' => 'SA','name' => 'Saudi Arabia','iso3' => 'SAU','number_code' => '682','phone_code' => '966'],
  		['short_name' => 'SN','name' => 'Senegal','iso3' => 'SEN','number_code' => '686','phone_code' => '221'],
  		['short_name' => 'CS','name' => 'Serbia and Montenegro','iso3' => NULL,'number_code' => NULL,'phone_code' => '381'],
  		['short_name' => 'SC','name' => 'Seychelles','iso3' => 'SYC','number_code' => '690','phone_code' => '248'],
  		['short_name' => 'SL','name' => 'Sierra Leone','iso3' => 'SLE','number_code' => '694','phone_code' => '232'],
  		['short_name' => 'SG','name' => 'Singapore','iso3' => 'SGP','number_code' => '702','phone_code' => '65'],
  		['short_name' => 'SK','name' => 'Slovakia','iso3' => 'SVK','number_code' => '703','phone_code' => '421'],
  		['short_name' => 'SI','name' => 'Slovenia','iso3' => 'SVN','number_code' => '705','phone_code' => '386'],
  		['short_name' => 'SB','name' => 'Solomon Islands','iso3' => 'SLB','number_code' => '90','phone_code' => '677'],
  		['short_name' => 'SO','name' => 'Somalia','iso3' => 'SOM','number_code' => '706','phone_code' => '252'],
  		['short_name' => 'ZA','name' => 'South Africa','iso3' => 'ZAF','number_code' => '710','phone_code' => '27'],
  		['short_name' => 'GS','name' => 'South Georgia and the South Sandwich Islands','iso3' => NULL,'number_code' => NULL,'phone_code' => '0'],
  		['short_name' => 'ES','name' => 'Spain','iso3' => 'ESP','number_code' => '724','phone_code' => '34'],
  		['short_name' => 'LK','name' => 'Sri Lanka','iso3' => 'LKA','number_code' => '144','phone_code' => '94'],
  		['short_name' => 'SD','name' => 'Sudan','iso3' => 'SDN','number_code' => '736','phone_code' => '249'],
  		['short_name' => 'SR','name' => 'Suriname','iso3' => 'SUR','number_code' => '740','phone_code' => '597'],
  		['short_name' => 'SJ','name' => 'Svalbard and Jan Mayen','iso3' => 'SJM','number_code' => '744','phone_code' => '47'],
  		['short_name' => 'SZ','name' => 'Swaziland','iso3' => 'SWZ','number_code' => '748','phone_code' => '268'],
  		['short_name' => 'SE','name' => 'Sweden','iso3' => 'SWE','number_code' => '752','phone_code' => '46'],
  		['short_name' => 'CH','name' => 'Switzerland','iso3' => 'CHE','number_code' => '756','phone_code' => '41'],
  		['short_name' => 'SY','name' => 'Syrian Arab Republic','iso3' => 'SYR','number_code' => '760','phone_code' => '963'],
  		['short_name' => 'TW','name' => 'Taiwan, Province of China','iso3' => 'TWN','number_code' => '158','phone_code' => '886'],
  		['short_name' => 'TJ','name' => 'Tajikistan','iso3' => 'TJK','number_code' => '762','phone_code' => '992'],
  		['short_name' => 'TZ','name' => 'Tanzania, United Republic of','iso3' => 'TZA','number_code' => '834','phone_code' => '255'],
  		['short_name' => 'TH','name' => 'Thailand','iso3' => 'THA','number_code' => '764','phone_code' => '66'],
  		['short_name' => 'TL','name' => 'Timor-Leste','iso3' => NULL,'number_code' => NULL,'phone_code' => '670'],
  		['short_name' => 'TG','name' => 'Togo','iso3' => 'TGO','number_code' => '768','phone_code' => '228'],
  		['short_name' => 'TK','name' => 'Tokelau','iso3' => 'TKL','number_code' => '772','phone_code' => '690'],
  		['short_name' => 'TO','name' => 'Tonga','iso3' => 'TON','number_code' => '776','phone_code' => '676'],
  		['short_name' => 'TT','name' => 'Trinidad and Tobago','iso3' => 'TTO','number_code' => '780','phone_code' => '1868'],
  		['short_name' => 'TN','name' => 'Tunisia','iso3' => 'TUN','number_code' => '788','phone_code' => '216'],
  		['short_name' => 'TR','name' => 'Turkey','iso3' => 'TUR','number_code' => '792','phone_code' => '90'],
  		['short_name' => 'TM','name' => 'Turkmenistan','iso3' => 'TKM','number_code' => '795','phone_code' => '7370'],
  		['short_name' => 'TC','name' => 'Turks and Caicos Islands','iso3' => 'TCA','number_code' => '796','phone_code' => '1649'],
  		['short_name' => 'TV','name' => 'Tuvalu','iso3' => 'TUV','number_code' => '798','phone_code' => '688'],
  		['short_name' => 'UG','name' => 'Uganda','iso3' => 'UGA','number_code' => '800','phone_code' => '256'],
  		['short_name' => 'UA','name' => 'Ukraine','iso3' => 'UKR','number_code' => '804','phone_code' => '380'],
  		['short_name' => 'AE','name' => 'United Arab Emirates','iso3' => 'ARE','number_code' => '784','phone_code' => '971'],
  		['short_name' => 'GB','name' => 'United Kingdom','iso3' => 'GBR','number_code' => '826','phone_code' => '44'],
  		['short_name' => 'US','name' => 'United States','iso3' => 'USA','number_code' => '840','phone_code' => '1'],
  		['short_name' => 'UM','name' => 'United States Minor Outlying Islands','iso3' => NULL,'number_code' => NULL,'phone_code' => '1'],
  		['short_name' => 'UY','name' => 'Uruguay','iso3' => 'URY','number_code' => '858','phone_code' => '598'],
  		['short_name' => 'UZ','name' => 'Uzbekistan','iso3' => 'UZB','number_code' => '860','phone_code' => '998'],
  		['short_name' => 'VU','name' => 'Vanuatu','iso3' => 'VUT','number_code' => '548','phone_code' => '678'],
  		['short_name' => 'VE','name' => 'Venezuela','iso3' => 'VEN','number_code' => '862','phone_code' => '58'],
  		['short_name' => 'VN','name' => 'Viet Nam','iso3' => 'VNM','number_code' => '704','phone_code' => '84'],
  		['short_name' => 'VG','name' => 'Virgin Islands, British','iso3' => 'VGB','number_code' => '92','phone_code' => '1284'],
  		['short_name' => 'VI','name' => 'Virgin Islands, U.s.','iso3' => 'VIR','number_code' => '850','phone_code' => '1340'],
  		['short_name' => 'WF','name' => 'Wallis and Futuna','iso3' => 'WLF','number_code' => '876','phone_code' => '681'],
  		['short_name' => 'EH','name' => 'Western Sahara','iso3' => 'ESH','number_code' => '732','phone_code' => '212'],
  		['short_name' => 'YE','name' => 'Yemen','iso3' => 'YEM','number_code' => '887','phone_code' => '967'],
  		['short_name' => 'ZM','name' => 'Zambia','iso3' => 'ZMB','number_code' => '894','phone_code' => '260'],
  		['short_name' => 'ZW','name' => 'Zimbabwe','iso3' => 'ZWE','number_code' => '716','phone_code' => '263']

        ]);
    }
}
