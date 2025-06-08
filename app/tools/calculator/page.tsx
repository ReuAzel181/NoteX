"use client"

import * as React from 'react'
import { useState } from 'react'
import { DashboardNav } from '@/components/dashboard-nav'
import { Button } from '@/components/ui/button'
import { History, RefreshCcw, X, Sparkles } from 'lucide-react'

export default function CalculatorPage() {
  const [display, setDisplay] = useState('0')
  const [history, setHistory] = useState<string[]>([])
  const [showHistory, setShowHistory] = useState(false)
  const [memory, setMemory] = useState<number>(0)

  const buttons = [
    ['sin', 'cos', 'tan', '(', ')', 'C'],
    ['7', '8', '9', '÷', 'sqrt', 'π'],
    ['4', '5', '6', '×', 'x²', 'log'],
    ['1', '2', '3', '-', 'x^y', 'ln'],
    ['0', '.', '=', '+', '%', 'e']
  ]

  const handleClick = (value: string) => {
    switch (value) {
      case 'C':
        setDisplay('0')
        break
      case '=':
        try {
          let expression = display
            .replace('×', '*')
            .replace('÷', '/')
            .replace('π', Math.PI.toString())
            .replace('e', Math.E.toString())
          
          // Handle scientific functions
          expression = expression
            .replace(/sin\(/g, 'Math.sin(')
            .replace(/cos\(/g, 'Math.cos(')
            .replace(/tan\(/g, 'Math.tan(')
            .replace(/sqrt\(/g, 'Math.sqrt(')
            .replace(/log\(/g, 'Math.log10(')
            .replace(/ln\(/g, 'Math.log(')
            .replace(/x²/g, '**2')
            .replace(/x\^y/g, '**')

          const result = eval(expression)
          setHistory([`${display} = ${result}`, ...history])
          setDisplay(result.toString())
        } catch (error) {
          setDisplay('Error')
        }
        break
      case 'sin':
      case 'cos':
      case 'tan':
      case 'sqrt':
      case 'log':
      case 'ln':
        setDisplay(display === '0' ? `${value}(` : `${display}${value}(`)
        break
      case 'x²':
        try {
          const result = Math.pow(parseFloat(display), 2)
          setDisplay(result.toString())
          setHistory([`${display}² = ${result}`, ...history])
        } catch {
          setDisplay('Error')
        }
        break
      case 'π':
        setDisplay(display === '0' ? Math.PI.toString() : display + Math.PI.toString())
        break
      case 'e':
        setDisplay(display === '0' ? Math.E.toString() : display + Math.E.toString())
        break
      default:
        setDisplay(display === '0' ? value : display + value)
    }
  }

  return (
    <div className="min-h-screen bg-gradient-to-br from-slate-50 via-blue-50 to-indigo-100 dark:from-slate-900 dark:via-slate-800 dark:to-slate-900">
      <DashboardNav />
      <main className="container mx-auto p-4 md:p-8">
        <div className="flex items-center justify-between mb-8">
          <div className="flex items-center space-x-3">
            <div className="relative">
              <Sparkles className="h-8 w-8 text-purple-500" />
              <div className="absolute inset-0 bg-purple-500/20 rounded-full blur-sm"></div>
            </div>
            <div>
              <h1 className="text-4xl font-bold bg-gradient-to-r from-purple-600 via-indigo-600 to-blue-600 bg-clip-text text-transparent">
                Scientific Calculator
              </h1>
              <p className="text-muted-foreground">Advanced mathematical computations</p>
            </div>
          </div>
          <div className="flex gap-4">
            <Button 
              variant={showHistory ? "default" : "outline"} 
              size="icon"
              onClick={() => setShowHistory(!showHistory)}
              className={`${showHistory ? 'bg-gradient-to-r from-purple-500 to-indigo-600' : 'border-white/20 bg-white/50 dark:bg-slate-800/50 backdrop-blur-sm hover:bg-white/70 dark:hover:bg-slate-700/70'} transition-all duration-300`}
            >
              <History className="h-4 w-4" />
            </Button>
            <Button 
              variant="outline" 
              size="icon" 
              onClick={() => setDisplay('0')}
              className="border-white/20 bg-white/50 dark:bg-slate-800/50 backdrop-blur-sm hover:bg-white/70 dark:hover:bg-slate-700/70 transition-all duration-300"
            >
              <RefreshCcw className="h-4 w-4" />
            </Button>
          </div>
        </div>
        
        <div className="flex gap-8">
          <div className="flex-1 max-w-md">
            <div className="bg-white/80 dark:bg-slate-800/80 backdrop-blur-sm border border-white/20 rounded-2xl p-6 shadow-xl hover:shadow-2xl transition-all duration-300">
              <div className="bg-gradient-to-r from-gray-100 to-gray-200 dark:from-slate-700 dark:to-slate-600 p-6 rounded-xl mb-6 text-right text-3xl font-mono overflow-x-auto border border-white/20">
                {display}
              </div>
              
              <div className="grid grid-cols-6 gap-3">
                {buttons.map((row, i) => (
                  row.map((btn, j) => (
                    <Button
                      key={`${i}-${j}`}
                      variant="outline"
                      className={`h-14 text-sm md:text-base font-medium transition-all duration-300 hover:scale-105 ${
                        btn === '=' ? 'bg-gradient-to-r from-purple-500 to-indigo-600 text-white hover:from-purple-600 hover:to-indigo-700' :
                        btn === 'C' ? 'bg-gradient-to-r from-red-500 to-pink-600 text-white hover:from-red-600 hover:to-pink-700' :
                        'border-white/20 bg-white/50 dark:bg-slate-700/50 backdrop-blur-sm hover:bg-white/70 dark:hover:bg-slate-600/70'
                      }`}
                      onClick={() => handleClick(btn)}
                    >
                      {btn}
                    </Button>
                  ))
                ))}
              </div>
            </div>
          </div>

          {showHistory && (
            <div className="w-80 bg-white/80 dark:bg-slate-800/80 backdrop-blur-sm border border-white/20 rounded-2xl p-6 shadow-xl transition-all duration-300">
              <div className="flex items-center justify-between mb-6">
                <h2 className="text-xl font-bold bg-gradient-to-r from-gray-800 to-gray-600 dark:from-gray-200 dark:to-gray-400 bg-clip-text text-transparent">
                  History
                </h2>
                <Button 
                  variant="ghost" 
                  size="icon"
                  onClick={() => setHistory([])}
                  className="text-gray-500 hover:text-red-500 transition-colors duration-200 p-2 rounded-lg hover:bg-red-500/10"
                >
                  <X className="h-4 w-4" />
                </Button>
              </div>
              <div className="space-y-3 max-h-[60vh] overflow-y-auto">
                {history.map((item, index) => (
                  <div 
                    key={index} 
                    className="text-sm p-3 hover:bg-white/50 dark:hover:bg-slate-700/50 rounded-xl cursor-pointer transition-all duration-200 hover:scale-105 border border-transparent hover:border-white/20"
                    onClick={() => setDisplay(item.split(' = ')[1])}
                  >
                    <div className="font-mono text-gray-800 dark:text-gray-200">{item}</div>
                  </div>
                ))}
                {history.length === 0 && (
                  <div className="text-center text-muted-foreground p-8 border-2 border-dashed border-gray-300 dark:border-gray-600 rounded-xl bg-white/50 dark:bg-slate-700/50 backdrop-blur-sm">
                    <div className="text-4xl mb-4">🧮</div>
                    <p className="text-lg font-medium mb-2">No calculations yet</p>
                    <p className="text-sm">Start computing to see your history</p>
                  </div>
                )}
              </div>
            </div>
          )}
        </div>
      </main>
    </div>
  )
} 