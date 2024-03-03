//import './bootstrap';
import { SafeConnector } from '@gnosis.pm/safe-apps-wagmi'
import { configureChains, createClient, getAccount, fetchBalance, prepareSendTransaction, 
    sendTransaction, waitForTransaction, disconnect,
    getContract, fetchSigner } from '@wagmi/core'
import { goerli, mainnet } from '@wagmi/core/chains'
import { EthereumClient, modalConnectors, walletConnectProvider } from '@web3modal/ethereum'
import { Web3Modal } from '@web3modal/html'
import { parseEther } from 'ethers/lib/utils.js'
import ABI from './boxaABI.json';





let isTestnet = document.getElementById("isTestnet").value;
//console.log("🚀 ~ file: app.js:12 ~ isTestnet", isTestnet)

// 1. Define constants
const projectId = '99b0c7c6b68c637045212d358a4b78cc'
let blockchainExplorer = 'https://etherscan.com';
let boxaCoinAddress = '0x7662c015D845EF487fDe32cb884653bE9c9E0110';
// let boxaRecieveWallet = '0x06E1552Ca52227e3015E5421480277966bdB077d'; // junaid
let boxaRecieveWallet = '0x3999d2a2cCA6D61473cEA8D705059EfE67835c29';
let chains = [mainnet];
if (isTestnet == 'yes') {
    blockchainExplorer = 'https://goerli.etherscan.io';
    chains = [goerli];
    boxaCoinAddress = '0x2170ed0880ac9a755fd29b2688956bd959f933f8';
    boxaRecieveWallet = '0xe581B718C7b51298a149f7055CD3bc077aFA055A'; // usman    
}
// boxaRecieveWallet = '0xe581B718C7b51298a149f7055CD3bc077aFA055A'; // usman    



// const chains = [goerli]

// 2. Configure wagmi client
const { provider } = configureChains(chains, [walletConnectProvider({ projectId })])
const wagmiClient = createClient({
  autoConnect: true,
  connectors: [...modalConnectors({ version: '1', projectId, appName: 'web3Modal', chains }), new SafeConnector({ chains })],
  provider
})

// 3. Create ethereum and modal clients
const ethereumClient = new EthereumClient(wagmiClient, chains)

export const web3Modal = new Web3Modal(
  {
    projectId,
    walletImages: {    
    }
  },
  ethereumClient
)

const unsubscribe = web3Modal.subscribeModal( async (newState) => {    
    if (newState.open === false) {
        const account = getAccount();        
        if (account.isConnected ) {        
            $("w3m-core-button").hide();
            const balance = await fetchBalance({            
                address: account.address,
                token: boxaCoinAddress
            });            
            sendUserBoxaAccount(account.address, balance.formatted);
        } else {
            sendUserBoxaAccount(null, null);
        }
    }

});



export async function transactionCall(amount_to_be_paid) {
    //console.log("🚀 ~ file: app.js:77 ~ transactionCall ~ amount_to_be_paid:", amount_to_be_paid)
    const account = await ethereumClient.getAccount();
    const signer = await fetchSigner();
    
    if (isTestnet === 'yes') {
        // return;
        $("#transactionHash").val(`Test`);
        $("#payment-form").submit();       
        return; 
    }


    let amount = amount_to_be_paid;
    if (isTestnet == 'yes') {
        amount = "0.00001";
    }
    if (boxaRecieveWallet == '0x06E1552Ca52227e3015E5421480277966bdB077d') {
        amount = "1";
    }
        
    try {        
        const contract = await getContract({
            address: boxaCoinAddress,
            abi: ABI,
            signerOrProvider: signer
        })        
        const response = await contract.transfer(boxaRecieveWallet, (amount * 10**9));        
        const txData = response.hash;        
        $("#transactionHash").val(`${blockchainExplorer}/tx/${txData}`);
        $("#payment-form").submit();        
    } catch (error) {
        //console.log("🚀 ~ file: app.js:78 ~ transactionCall ~ error", error)
        //console.log("🚀 ~ file: app.js:78 ~ transactionCall ~ error", error.code);
        //console.log(error.reason)
        $("#payWithBoxaButton").attr("disabled", false);
        //console.log(error.code )
        if (error.code == 'ACTION_REJECTED') {
            alert("User denied transaction");
        }else if(error.code == 'UNPREDICTABLE_GAS_LIMIT'){
            alert(error.reason.replace('execution reverted:',''));
        }
    }

}

async function checkTokenConnection() {
    const account = await ethereumClient.getAccount();        
    if (account.isConnected) {        
        $("w3m-core-button").hide();
        $("#payWithBoxaButton").removeClass('display-off');                
    } else {
        $("#boxaViewDiv").addClass('display-off');
    }
}

async function disconnectWallet() {
    await disconnect()
    sendUserBoxaAccount(null, null);
}

window.transactionCall=transactionCall;
window.disconnectWallet=disconnectWallet;
window.onload = checkTokenConnection;

setTimeout(function(){
    $.ajax({
        url:'/',
        success:function(data){
         
        },
        error:function(data){
            disconnectWallet();
        }
    })
},(1000*60*119)); // 120 session out 

