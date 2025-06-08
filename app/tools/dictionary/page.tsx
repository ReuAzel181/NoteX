"use client"

import * as React from 'react'
import { useState, useEffect } from 'react'
import { DashboardNav } from '@/components/dashboard-nav'
import { Button } from '@/components/ui/button'
import { Search, BookmarkPlus, Bookmark, Volume, X, Sparkles } from 'lucide-react'

interface WordDefinition {
  word: string;
  phonetic: string;
  meanings: {
    partOfSpeech: string;
    definitions: {
      definition: string;
      example?: string;
    }[];
  }[];
  phonetics: {
    audio?: string;
  }[];
}

export default function DictionaryPage() {
  const [searchTerm, setSearchTerm] = useState('')
  const [loading, setLoading] = useState(false)
  const [result, setResult] = useState<WordDefinition | null>(null)
  const [error, setError] = useState('')
  const [savedWords, setSavedWords] = useState<string[]>([])
  const [showSaved, setShowSaved] = useState(false)

  useEffect(() => {
    const saved = localStorage.getItem('savedWords')
    if (saved) {
      setSavedWords(JSON.parse(saved))
    }
  }, [])

  const handleSearch = async (word: string = searchTerm) => {
    if (!word.trim()) return
    setLoading(true)
    setError('')
    setResult(null)

    try {
      const response = await fetch(`https://api.dictionaryapi.dev/api/v2/entries/en/${word.toLowerCase()}`)
      if (!response.ok) throw new Error('Word not found')
      
      const data = await response.json()
      setResult({
        word: data[0].word,
        phonetic: data[0].phonetic || '',
        meanings: data[0].meanings,
        phonetics: data[0].phonetics
      })
    } catch (err) {
      setError(err instanceof Error ? err.message : 'Failed to fetch definition')
    } finally {
      setLoading(false)
    }
  }

  const toggleSaveWord = (word: string) => {
    const newSavedWords = savedWords.includes(word)
      ? savedWords.filter(w => w !== word)
      : [...savedWords, word]
    
    setSavedWords(newSavedWords)
    localStorage.setItem('savedWords', JSON.stringify(newSavedWords))
  }

  const playAudio = (audioUrl: string) => {
    const audio = new Audio(audioUrl)
    audio.play()
  }

  return (
    <div className="min-h-screen bg-gradient-to-br from-slate-50 via-blue-50 to-indigo-100 dark:from-slate-900 dark:via-slate-800 dark:to-slate-900">
      <DashboardNav />
      <main className="container mx-auto p-4 md:p-8">
        <div className="flex items-center justify-between mb-8">
          <div className="flex items-center space-x-3">
            <div className="relative">
              <Sparkles className="h-8 w-8 text-orange-500" />
              <div className="absolute inset-0 bg-orange-500/20 rounded-full blur-sm"></div>
            </div>
            <div>
              <h1 className="text-4xl font-bold bg-gradient-to-r from-orange-600 via-red-600 to-pink-600 bg-clip-text text-transparent">
                Intelligent Dictionary
              </h1>
              <p className="text-muted-foreground">AI-powered word definitions and examples</p>
            </div>
          </div>
          <Button 
            variant={showSaved ? "default" : "outline"}
            size="icon"
            onClick={() => setShowSaved(!showSaved)}
            className={`${showSaved ? 'bg-gradient-to-r from-orange-500 to-red-600' : 'border-white/20 bg-white/50 dark:bg-slate-800/50 backdrop-blur-sm hover:bg-white/70 dark:hover:bg-slate-700/70'} transition-all duration-300`}
          >
            <BookmarkPlus className="h-4 w-4" />
          </Button>
        </div>
        
        <div className="flex gap-8">
          <div className="flex-1 max-w-4xl">
            <div className="flex gap-4 mb-8">
              <input
                type="text"
                placeholder="Enter a word to discover its meaning..."
                className="flex-1 px-6 py-4 rounded-xl border border-white/20 bg-white/50 dark:bg-slate-800/50 backdrop-blur-sm focus:outline-none focus:ring-2 focus:ring-orange-500/50 focus:border-transparent transition-all duration-300 placeholder:text-gray-500 dark:placeholder:text-gray-400"
                value={searchTerm}
                onChange={(e) => setSearchTerm(e.target.value)}
                onKeyDown={(e) => e.key === 'Enter' && handleSearch()}
              />
              <Button 
                onClick={() => handleSearch()} 
                disabled={loading}
                className="bg-gradient-to-r from-orange-500 to-red-600 hover:from-orange-600 hover:to-red-700 text-white px-6 py-4 rounded-xl transition-all duration-300 hover:scale-105 hover:shadow-lg"
              >
                <Search className="h-4 w-4 mr-2" />
                Search
              </Button>
            </div>
            
            <div className="bg-white/80 dark:bg-slate-800/80 backdrop-blur-sm border border-white/20 rounded-2xl p-8 shadow-xl hover:shadow-2xl transition-all duration-300">
              {loading && (
                <div className="text-center text-muted-foreground">
                  <div className="animate-spin rounded-full h-12 w-12 border-b-2 border-orange-500 mx-auto mb-4"></div>
                  <p className="text-lg">Searching for definitions...</p>
                </div>
              )}

              {error && (
                <div className="text-center text-red-500 p-8 border-2 border-dashed border-red-300 dark:border-red-600 rounded-xl bg-red-50 dark:bg-red-900/20 backdrop-blur-sm">
                  <div className="text-4xl mb-4">❌</div>
                  <p className="text-lg font-medium mb-2">Word not found</p>
                  <p className="text-sm">Try searching for a different word</p>
                </div>
              )}

              {!loading && !error && !result && (
                <div className="text-center text-muted-foreground p-12 border-2 border-dashed border-gray-300 dark:border-gray-600 rounded-xl bg-white/50 dark:bg-slate-700/50 backdrop-blur-sm">
                  <Search className="h-16 w-16 mx-auto mb-6 opacity-20" />
                  <p className="text-lg font-medium mb-2">Ready to explore words?</p>
                  <p className="text-sm">Enter a word above to see its definition, pronunciation, and examples.</p>
                </div>
              )}

              {result && (
                <div>
                  <div className="flex items-center justify-between mb-8">
                    <div>
                      <h2 className="text-3xl font-bold bg-gradient-to-r from-gray-800 to-gray-600 dark:from-gray-200 dark:to-gray-400 bg-clip-text text-transparent">{result.word}</h2>
                      {result.phonetic && (
                        <p className="text-lg text-muted-foreground mt-2">{result.phonetic}</p>
                      )}
                    </div>
                    <div className="flex gap-3">
                      {result.phonetics[0]?.audio && (
                        <Button
                          variant="outline"
                          size="icon"
                          onClick={() => playAudio(result.phonetics[0].audio!)}
                          className="border-white/20 bg-white/50 dark:bg-slate-700/50 backdrop-blur-sm hover:bg-white/70 dark:hover:bg-slate-600/70 transition-all duration-300 hover:scale-105"
                        >
                          <Volume className="h-4 w-4" />
                        </Button>
                      )}
                      <Button
                        variant={savedWords.includes(result.word) ? "default" : "outline"}
                        size="icon"
                        onClick={() => toggleSaveWord(result.word)}
                        className={`${savedWords.includes(result.word) ? 'bg-gradient-to-r from-orange-500 to-red-600' : 'border-white/20 bg-white/50 dark:bg-slate-700/50 backdrop-blur-sm hover:bg-white/70 dark:hover:bg-slate-600/70'} transition-all duration-300 hover:scale-105`}
                      >
                        {savedWords.includes(result.word) ? (
                          <Bookmark className="h-4 w-4" />
                        ) : (
                          <BookmarkPlus className="h-4 w-4" />
                        )}
                      </Button>
                    </div>
                  </div>

                  <div className="space-y-8">
                    {result.meanings.map((meaning, index) => (
                      <div key={index} className="bg-white/50 dark:bg-slate-700/50 backdrop-blur-sm rounded-xl p-6 border border-white/20">
                        <h3 className="font-bold text-xl mb-4 text-orange-600 dark:text-orange-400">
                          {meaning.partOfSpeech}
                        </h3>
                        <ol className="list-decimal list-inside space-y-4">
                          {meaning.definitions.map((def, i) => (
                            <li key={i} className="text-base leading-relaxed">
                              <span className="text-gray-800 dark:text-gray-200">{def.definition}</span>
                              {def.example && (
                                <p className="ml-6 mt-3 text-gray-600 dark:text-gray-400 italic">
                                  Example: "{def.example}"
                                </p>
                              )}
                            </li>
                          ))}
                        </ol>
                      </div>
                    ))}
                  </div>
                </div>
              )}
            </div>
          </div>

          {showSaved && (
            <div className="w-80 bg-white/80 dark:bg-slate-800/80 backdrop-blur-sm border border-white/20 rounded-2xl p-6 shadow-xl transition-all duration-300">
              <div className="flex items-center justify-between mb-6">
                <h2 className="text-xl font-bold bg-gradient-to-r from-gray-800 to-gray-600 dark:from-gray-200 dark:to-gray-400 bg-clip-text text-transparent">
                  Saved Words
                </h2>
                <Button 
                  variant="ghost" 
                  size="icon"
                  onClick={() => setSavedWords([])}
                  className="text-gray-500 hover:text-red-500 transition-colors duration-200 p-2 rounded-lg hover:bg-red-500/10"
                >
                  <X className="h-4 w-4" />
                </Button>
              </div>
              <div className="space-y-3 max-h-[60vh] overflow-y-auto">
                {savedWords.map((word) => (
                  <div 
                    key={word}
                    className="flex items-center justify-between p-3 hover:bg-white/50 dark:hover:bg-slate-700/50 rounded-xl cursor-pointer transition-all duration-200 hover:scale-105 border border-transparent hover:border-white/20"
                    onClick={() => {
                      setSearchTerm(word)
                      handleSearch(word)
                    }}
                  >
                    <span className="text-sm font-medium text-gray-800 dark:text-gray-200">{word}</span>
                    <Button
                      variant="ghost"
                      size="icon"
                      onClick={(e) => {
                        e.stopPropagation()
                        toggleSaveWord(word)
                      }}
                      className="text-gray-500 hover:text-red-500 transition-colors duration-200 p-1 rounded-lg hover:bg-red-500/10"
                    >
                      <X className="h-3 w-3" />
                    </Button>
                  </div>
                ))}
                {savedWords.length === 0 && (
                  <div className="text-center text-muted-foreground p-8 border-2 border-dashed border-gray-300 dark:border-gray-600 rounded-xl bg-white/50 dark:bg-slate-700/50 backdrop-blur-sm">
                    <div className="text-4xl mb-4">📚</div>
                    <p className="text-lg font-medium mb-2">No saved words yet</p>
                    <p className="text-sm">Save interesting words for later reference</p>
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